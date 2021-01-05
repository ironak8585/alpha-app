<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DiamondColor;
use App\Models\Master\DiamondColorIntensity;
use App\Models\Master\DiamondShape;
use App\Models\Master\DiamondClarity;
use App\Models\Master\DiamondCut;
use App\Models\Master\DiamondPolish;
use App\Models\Master\DiamondSymmetry;
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
        $clarities = DiamondClarity::getObjects();
        $cuts = DiamondCut::getObjects();
        $polishes = DiamondPolish::getObjects();
        $symmetries = DiamondSymmetry::getObjects();
        //send response
        return view('master.diamonds.properties', compact('colors', 'shapes', 'intensities', 'clarities', 'cuts', 'polishes', 'symmetries'));
    }
}
