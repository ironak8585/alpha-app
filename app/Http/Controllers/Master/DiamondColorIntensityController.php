<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondColorIntensity;
use App\Helpers\FilterHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class DiamondColorIntensityController extends Controller
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
        $this->validate($request, [
            'name' => 'required',
        ]);
        //prepare data
        $data = $request->except('_token');
        $data['is_white'] = isset($request->is_white) ? true : false;

        //save
        try {
            DiamondColorIntensity::create($data);
            return back()
                ->with('success', 'Diamond Color Intensity has been added')
                ->with('property', 'intensity');
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
        $intensity = DiamondColorIntensity::find($id);
        return view('master.intensities.show', ['intensity' => $intensity]);
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
        $intensity = DiamondColorIntensity::find($id);
        return view('master.intensities.edit', ['intensity' => $intensity]);
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
        $intensity = DiamondColorIntensity::find($id);
        try {
            $intensity->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Color Intensity has been updated')
                ->with('property', 'intensity');
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
        $intensity = DiamondColorIntensity::find($id);
        try {
            $intensity->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Color Intensity has been deleted')
                ->with('property', 'intensity');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Color Intensity can not be deleted');
        }
    }
}
