<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //

     public  function index(Request $request){
        $state = $request->state;
     
        $cities = City::whereStateId($state)->orderBy('name')->select(['id', 'name'])->get();

        return $cities;
    }
    
}
