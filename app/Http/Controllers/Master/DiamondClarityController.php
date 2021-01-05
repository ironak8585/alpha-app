<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondClarity;

class DiamondClarityController extends Controller
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
            DiamondClarity::create($request->all());
            return back()
                ->with('success', 'Diamond Clarity has been added')
                ->with('property', 'clarity');
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
        $clarity = DiamondClarity::find($id);
        return view('master.clarities.show', ['clarity' => $clarity]);
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
        $clarity = DiamondClarity::find($id);
        return view('master.clarities.edit', ['clarity' => $clarity]);
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
        $clarity = DiamondClarity::find($id);
        try {
            $clarity->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Clarity has been updated')
                ->with('property', 'clarity');
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
        $clarity = DiamondClarity::find($id);
        try {
            $clarity->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Clarity has been deleted')
                ->with('property', 'clarity');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Clarity can not be deleted');
        }
    }
}
