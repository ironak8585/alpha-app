<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Admin\MyRole;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Get current logged user
     *
     * @return App\Models\Admin\User\User
     */
    public function user(Request $request)
    {
        return $request->user();
    }

    /**
     * Update password
     */
    public function password(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                $loggedUser = Auth::user();
                return view('auth.passwords.logged_reset', ['user' => $loggedUser]);
                break;
            case 'POST':
                $loggedUser = Auth::user();
                if ($request->password === $request->current_password) {
                    return back()->withErrors(['Enter new password']);
                }
                if ($request->password !== $request->password_confirmation) {
                    return back()->withErrors(['Password and its confirmation do not match']);
                }
                if ($loggedUser->password != null) {
                    if (!Auth::attempt(['email' => $loggedUser->email, 'password' => $request->current_password])) {
                        return back()->withErrors(['Invalid current password']);
                    }
                }
                $user = User::find($loggedUser->id);
                $user->password = Hash::make($request->password);
                if (!$user->save()) {
                    return back()->withErrors(['User password could not be change. Please try again.']);
                }
                Auth::logout();
                return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $query = User::with('roles');
        $query = FilterHelper::apply($request, $query, $equals = [], $skips = ['role']);
        if (in_array('role', array_keys($request->all()))) {
            $role = $request->role;
            $query = $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', '=', $role);
            });
        }
        //except super admin account
        $query = $query->whereHas('roles', function ($q) {
            $q->where('name', '!=', Config::get('constants.USER.ROLES.SUPER_ADMIN'));
            // $q->where('name', '!=', Config::get('constants.USER.ROLES.ADMIN'));
        });
        $records = $query->paginate(FilterHelper::rpp($request));

        //get roles for filter
        $roles = MyRole::getRoleNames();

        return view('admin.users.index', [
            'records' => $records,
            'roles' => $roles,
            'filters' => $request->all(),
            'rpp' => FilterHelper::rpp($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $roles = MyRole::getRoleNames();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'roles' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];
        try {
            User::add($data, $request->input('roles'));
            return back()->with('success', 'User has been added');
        } catch (\Throwable $th) {
            return back()->withErrors(['Error in user create : ', $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $code)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        //get object
        $user = (new User())->findCode($code);

        //get roles
        $roles = MyRole::getRoleNames();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\User\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        if ($user->update($request->all())) {
            return redirect()->route('admin.users.index')->with('success', 'User detail has been updated');
        }
        return back()->withErrors('User detail can not be updated');
    }

    /**
     * Show the form for updating password
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function adminPassword(Request $request, $code)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        $user = (new User())->findCode($code);
        switch ($request->method()) {
            case 'GET':
                return view('admin.users.password', ['user' => $user]);
                break;
            case 'POST':
                $this->validate($request, [
                    'password' => 'required|string|min:6|confirmed',
                ]);
                if ($request->password !== $request->password_confirmation) {
                    return back()->withErrors(['Password and its confirmation do not match']);
                }
                $user->password = Hash::make($request->password);
                if (!$user->save()) {
                    return back()->withErrors(['User password could not be reset. Please try again.']);
                }
                return redirect()->route('admin.users.index')->with('success', 'User password has been reset');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $code)
    {
        if (!Gate::allows('users_manage')) {
            return abort(401);
        }
        //get object
        $user = (new User())->findCode($code);
        if ($user->delete()) {
            return redirect()->route('admin.users.index')->with('success', 'User has been deleted');
        }
        return back()->withErrors('User can not be delete');
    }

    /**
     * Add role to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request)
    {
        if (!Gate::allows('roles_manage')) {
            return abort(401);
        }
        $this->validate($request, [
            'user' => Rule::exists('users', 'id'),
            'roles' => 'required|array|min:1',
        ]);
        //get roles
        $roles = MyRole::whereIn('name', $request->roles)->get();

        //get user
        $user = User::find($request->user);
        try {
            $user->assignRole($roles);
            //$user->roles()->attach($role);
            return redirect()->route('admin.users.index')->with('success', 'Role added for User');
        } catch (\Throwable $th) {
            return back()->withErrors('Error : ' . $th->getMessage());
        }
    }

    /**
     * Remove role for user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\User\User $user
     * @param  string $role
     * @return \Illuminate\Http\Response
     */
    public function removeRole(Request $request, User $user, string $role)
    {
        if (!Gate::allows('roles_manage')) {
            return abort(401);
        }
        if (count($user->roles) <= 1) {
            return back()->withErrors('Last role can not be removed');
        }
        //get role
        $dRole = MyRole::where('name', $role)->first();
        try {
            $user->removeRole($dRole);
            return redirect()->route('admin.users.index')->with('success', 'Role removed for User');
        } catch (\Throwable $th) {
            return back()->withErrors('Role can not be removed. Error : ' . $th->getMessage());
        }
    }
}
