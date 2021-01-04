<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DiamondColor;
use App\Models\Master\DiamondColorIntensity;
use App\Models\Master\DiamondShape;
use Illuminate\Http\Request;

class DiamondPropertyController extends Controller
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
    public function properties(Request $request)
    {
        //get properties
        $colors = DiamondColor::getObjects();
        $shapes = DiamondShape::getObjects();
        $intensities = DiamondColorIntensity::getObjects();
        //send response
        return view('master.diamonds.properties', compact('colors', 'shapes', 'intensities'));
    }
}
