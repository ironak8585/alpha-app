<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
     * Display a listing of Role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Role::query();
        $query->where('name', '!=', Config::get('constants.USER.ROLES.SUPER_ADMIN'));
        if ($user->isAdmin() && !$user->isSuperAdmin()) {
            $query->where('name', '!=', Config::get('constants.USER.ROLES.ADMIN'));
        }
        $query = FilterHelper::apply($request, $query, $equals = [], $skips = []);
        $query->orderBy('id', 'desc');
        $records = $query->paginate(FilterHelper::rpp($request));
        return view('admin.roles.index', ['records' => $records, 'filters' => $request->all(), 'rpp' => FilterHelper::rpp($request)]);
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('guard_name', '=', 'web')->get()->pluck('description', 'name');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
            'permissions' => 'required|array|min:1',
        ]);

        //get permissions
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];
        $data = $request->except('permissions');
        $data['name'] = Str::upper(Str::snake(Str::lower($data['name'])));

        try {
            DB::transaction(function () use ($data, $permissions) {
                $role = Role::create($data);
                $role->givePermissionTo($permissions);
            });
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['Error in create', $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::where('guard_name', '=', 'web')->get()->pluck('description', 'name');
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
            'permissions' => 'required|array|min:1',
        ]);

        //get role
        $role = Role::findOrFail($id);

        //prepare data
        $permissions = $request->input('permissions') ? $request->input('permissions') : [];
        $data = $request->except('permissions');
        $data['name'] = Str::upper(Str::snake(Str::lower($data['name'])));

        try {
            DB::transaction(function () use ($role, $data, $permissions) {
                $role->update($data);
                $role->syncPermissions($permissions);
            });
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            return back()->withErrors(['Error in update', $th->getMessage()]);
        }
    }

    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index');
    }
}
