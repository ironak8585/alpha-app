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
        $query = DiamondShape::with($related);
        $query = FilterHelper::apply($request, $query, $equals = [], $skips = []);

        //get records
        $records = $query->paginate(FilterHelper::rpp($request));

        //send response
        return view('master.diamondshapes.index', [
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
        return view('master.diamondshapes.create');
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
            return back()->with('success', 'DiamondShape has been added');
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
        $diamondshape = DiamondShape::find($id);
        return view('master.diamondshapes.show', ['diamondshape' => $diamondshape]);
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
        $diamondshape = DiamondShape::find($id);
        return view('master.diamondshapes.edit', ['diamondshape' => $diamondshape]);
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
        $diamondshape = DiamondShape::find($id);
        try {
            $diamondshape->update($request->all());
            return redirect()
                ->route('master.diamondshapes.index')
                ->with('success', 'DiamondShape has been updated');
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
        $diamondshape = DiamondShape::find($id);
        try {
            $diamondshape->delete();
            return redirect()
                ->route('master.diamondshapes.index')
                ->with('success', 'DiamondShape has been deleted');
        } catch (\Throwable $th) {
            return back()->withErrors('DiamondShape can not be deleted');
        }
    }
}
