<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $houses = Apartment::all();
        return view('property.property', compact('houses'));
    }
    public function show($slug)
    {
        return view('property.property-details');
    }
}
