<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondCut;

class DiamondCutController extends Controller
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
            DiamondCut::create($request->all());
            return back()
                ->with('success', 'Diamond Cut has been added')
                ->with('property', 'cut');
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
        $cut = DiamondCut::find($id);
        return view('master.cuts.show', ['cut' => $cut]);
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
        $cut = DiamondCut::find($id);
        return view('master.cuts.edit', ['cut' => $cut]);
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
        $cut = DiamondCut::find($id);
        try {
            $cut->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Cut has been updated')
                ->with('property', 'cut');
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
        $cut = DiamondCut::find($id);
        try {
            $cut->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Cut has been deleted')
                ->with('property', 'cut');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Cut can not be deleted');
        }
    }
}
