<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondSymmetry;

class DiamondSymmetryController extends Controller
{

    protected $redirect;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //all actions requires login
        $this->middleware('auth');
        $this->redirect = 'master.diamonds.properties';
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
            'code' => 'required',
            'name' => 'required',
        ]);
        try {
            DiamondSymmetry::create($request->all());
            return back()
                ->with('success', 'Diamond Symmetry has been added')
                ->with('property', 'symmetry');
        } catch (\Throwable $th) {
            return back()->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $symmetry = DiamondSymmetry::find($id);
        return view('master.symmetries.show', ['symmetry' => $symmetry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get object
        $symmetry = DiamondSymmetry::find($id);
        return view('master.symmetries.edit', ['symmetry' => $symmetry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);
        $symmetry = DiamondSymmetry::find($id);
        try {
            $symmetry->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Symmetry has been updated')
                ->with('property', 'symmetry');
        } catch (\Throwable $th) {
            return back()->withErrors([$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get object
        $symmetry = DiamondSymmetry::find($id);
        try {
            $symmetry->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Symmetry has been deleted')
                ->with('property', 'symmetry');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Symmetry can not be deleted');
        }
    }
}
