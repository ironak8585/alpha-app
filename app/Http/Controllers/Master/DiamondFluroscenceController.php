<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondFluroscence;

class DiamondFluroscenceController extends Controller
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
            'name' => 'required',
        ]);
        try {
            DiamondFluroscence::create($request->all());
            return back()
                ->with('success', 'Diamond Fluroscence has been added')
                ->with('property', 'fluroscence');
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
        $fluroscence = DiamondFluroscence::find($id);
        return view('master.fluroscences.show', ['fluroscence' => $fluroscence]);
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
        $fluroscence = DiamondFluroscence::find($id);
        return view('master.fluroscences.edit', ['fluroscence' => $fluroscence]);
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
        $fluroscence = DiamondFluroscence::find($id);
        try {
            $fluroscence->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Fluroscence has been updated')
                ->with('property', 'fluroscence');
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
        $fluroscence = DiamondFluroscence::find($id);
        try {
            $fluroscence->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Fluroscence has been deleted')
                ->with('property', 'fluroscence');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Fluroscence can not be deleted');
        }
    }
}
