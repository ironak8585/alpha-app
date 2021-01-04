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
        $query = DiamondColor::with($related);
        $query = FilterHelper::apply($request, $query, $equals = [], $skips = []);

        //get records
        $records = $query->paginate(FilterHelper::rpp($request));

        //send response
        return view('master.diamondcolors.index', [
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
        return view('master.diamondcolors.create');
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
            DiamondColor::create($request->all());
            return back()->with('success', 'DiamondColor has been added');
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
        $diamondcolor = DiamondColor::find($id);
        return view('master.diamondcolors.show', ['diamondcolor' => $diamondcolor]);
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
        $diamondcolor = DiamondColor::find($id);
        return view('master.diamondcolors.edit', ['diamondcolor' => $diamondcolor]);
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
        $diamondcolor = DiamondColor::find($id);
        try {
            $diamondcolor->update($request->all());
            return redirect()
                ->route('master.diamondcolors.index')
                ->with('success', 'DiamondColor has been updated');
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
        $diamondcolor = DiamondColor::find($id);
        try {
            $diamondcolor->delete();
            return redirect()
                ->route('master.diamondcolors.index')
                ->with('success', 'DiamondColor has been deleted');
        } catch (\Throwable $th) {
            return back()->withErrors('DiamondColor can not be deleted');
        }
    }
}
