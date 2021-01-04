<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondColor;
use App\Helpers\FilterHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class DiamondColorController extends Controller
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
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $color = DiamondColor::find($id);
        return view('master.colors.show', ['color' => $color]);
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
        $color = DiamondColor::find($id);
        return view('master.colors.edit', ['color' => $color]);
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
        $color = DiamondColor::find($id);
        try {
            $color->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Color has been updated')
                ->with('property', 'color');
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
        $color = DiamondColor::find($id);
        try {
            $color->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Color has been deleted')
                ->with('property', 'color');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Color can not be deleted');
        }
    }
}
