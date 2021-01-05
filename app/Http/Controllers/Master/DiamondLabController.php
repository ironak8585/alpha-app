<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondLab;

class DiamondLabController extends Controller
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
            DiamondLab::create($request->all());
            return back()
                ->with('success', 'Diamond Lab has been added')
                ->with('property', 'lab');
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
        $lab = DiamondLab::find($id);
        return view('master.labs.show', ['lab' => $lab]);
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
        $lab = DiamondLab::find($id);
        return view('master.labs.edit', ['lab' => $lab]);
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
        $lab = DiamondLab::find($id);
        try {
            $lab->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Lab has been updated')
                ->with('property', 'lab');
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
        $lab = DiamondLab::find($id);
        try {
            $lab->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Lab has been deleted')
                ->with('property', 'lab');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Lab can not be deleted');
        }
    }
}
