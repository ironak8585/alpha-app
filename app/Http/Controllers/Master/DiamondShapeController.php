<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\DiamondShape;
use App\Helpers\FilterHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;

class DiamondShapeController extends Controller
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
            DiamondShape::create($request->all());
            return back()
                ->with('success', 'Diamond Shape has been added')
                ->with('property', 'shape');
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
        $shape = DiamondShape::find($id);
        return view('master.shapes.show', ['shape' => $shape]);
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
        $shape = DiamondShape::find($id);
        return view('master.shapes.edit', ['shape' => $shape]);
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
        $shape = DiamondShape::find($id);
        try {
            $shape->update($request->all());
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Shape has been updated')
                ->with('property', 'shape');
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
        $shape = DiamondShape::find($id);
        try {
            $shape->delete();
            return redirect()
                ->route($this->redirect)
                ->with('success', 'Diamond Shape has been deleted')
                ->with('property', 'shape');
        } catch (\Throwable $th) {
            return back()->withErrors('Diamond Shape can not be deleted');
        }
    }
}
