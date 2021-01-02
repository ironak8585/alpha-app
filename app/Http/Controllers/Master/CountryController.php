<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Country;
use App\Helpers\FilterHelper;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericExport;


class CountryController extends Controller
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
        $query = Country::with($related);
        $query = FilterHelper::apply($request, $query, $equals = [], $skips = []);

        //get records
        $records = $query->paginate(FilterHelper::rpp($request));

        //send response
        return view('master.countries.index', [
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
        return view('master.countries.create');
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
            Country::create($request->all());
            return back()->with('success', 'Country has been added');
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
        $country = Country::find($id);
        return view('master.countries.show', ['country' => $country]);
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
        $country = Country::find($id);
        return view('master.countries.edit', ['country' => $country]);
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
        $country = Country::find($id);
        try {
            $country->update($request->all());
            return redirect()
                ->route('master.countries.index')
                ->with('success', 'Country has been updated');
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
        $country = Country::find($id);
        try {
            $country->delete();
            return redirect()
                ->route('master.countries.index')
                ->with('success', 'Country has been deleted');
        } catch (\Throwable $th) {
            return back()->withErrors('Country can not be deleted');
        }
    }

    /**
     * Store multiple records via import.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        switch ($request->method()) {
            case 'GET':
                return view('master.countries.import');
                break;
            case 'POST':
                $this->validate($request, [
                    'file' => 'required|file',
                ]);

                //store file
                //$path = $request->file('file')->store('imports/master');

                try {
                    Country::import($request->file('file'));
                    return redirect()->route('master.countries.index')->with('success', 'Detail of all countries have been imported successfully.');
                } catch (ValidationException $th) {
                    throw $th;
                } catch (\Throwable $th) {
                    throw $th;
                    return back()->withErrors(['Error in import', $th->getMessage()]);
                }
                break;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        //
        $this->validate($request, []);

        //get records
        $records = Country::select(['name', 'created_at'])->get();

        //export queries to excel sheet
        try {
            $headers = ['NAME', 'CREATED AT'];
            $map = ['name', 'created_at'];
            $export = new GenericExport($records, $headers, 'Country', $map);

            $timestamp = Carbon::now()->timestamp;
            $filename = $timestamp . ".xlsx";
            return Excel::download($export, $filename);
        } catch (\Throwable $th) {
            return back()->withErrors(['Error in query export', $th->getMessage()]);
        }
    }
}
