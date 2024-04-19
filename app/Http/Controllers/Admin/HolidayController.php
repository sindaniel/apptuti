<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $holidays = Holiday::query()
        ->orderBy('date')
        ->where('date', '>=', now())
        ->when($request->type_id, function ($query, $type_id) {
            return $query->where('type_id', $type_id);
        })
        ->paginate();
       
        $context = compact('holidays'); 
        
        return view('holidays.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('holidays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'type_id' => 'required',
            'date'=> 'required|date',
        ]);

        if($validate['type_id'] == Holiday::SATURDAY){
            //validate if date is saturday
            if(date('N', strtotime($validate['date'])) != 6){
                return back()->with('error', 'La fecha no es un sábado')->withInput();
            }
        }
        

        Holiday::create($validate);

        return to_route('holidays.index')->with('success', 'Festivo creado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return to_route('holidays.index')->with('success', 'Festivo eliminado');
    }
}
