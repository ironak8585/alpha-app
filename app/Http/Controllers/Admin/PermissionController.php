<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //all actions requires login
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //prepare query
        $related = [];
        $query = Permission::with($related);
        $query = FilterHelper::apply($request, $query, $equals = [], $skips = []);

        //get records
        $records = $query->paginate(FilterHelper::rpp($request));

        //send response
        return view('admin.permissions.index', [
            'records' => $records,
            'filters' => FilterHelper::filters($request),
            'rpp' => FilterHelper::rpp($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);
        try {
            Permission::create($request->all());
            return back()->with('success', 'Permission has been added');
        } catch (\Throwable $th) {
            return back()->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get object
        $permission = Permission::find($id);
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $permission = Permission::find($id);
        try {
            $permission->update($request->all());
            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission has been updated');
        } catch (\Throwable $th) {
            return back()->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get object
        $permission = Permission::find($id);
        try {
            $permission->delete();
            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission has been deleted');
        } catch (\Throwable $th) {
            return back()->withErrors('Permission can not be deleted');
        }
    }
}
