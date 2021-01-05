<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondPolish;

class DiamondPolishController extends Controller
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
            DiamondPolish::create($request->all());
            return back()
                ->with('success', 'Diamond Polish has been added')
                ->with('property', 'polish');
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
        $polish = DiamondPolish::find($id);
        return view('master.polishes.show', ['polish' => $polish]);
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
        $polish = DiamondPolish::find($id);
        return view('master.polishes.edit', ['polish' => $polish]);
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
        $polish = DiamondPolish::find($id);
        try {
            $polish->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Polish has been updated')
                ->with('property', 'polish');
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
        $polish = DiamondPolish::find($id);
        try {
            $polish->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Polish has been deleted')
                ->with('property', 'polish');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Polish can not be deleted');
        }
    }
}
