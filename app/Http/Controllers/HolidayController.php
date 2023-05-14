<?php

namespace App\Http\Controllers;

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
        ->when($request->q, function($query, $q){
            $query->where('name', 'like', "%{$q}%");
        })
        ->orderBy('date')
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
            'name' => 'required|string|max:255',
            'date'=> 'required|date',
        ]);
        

        Holiday::create($validate);

        return to_route('holidays.index')->with('success', 'Festivo creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        $context = compact('holiday');
        return view('holidays.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holiday $holiday)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'date'=> 'required|date',
        ]);

        $holiday->update($validate);

        return to_route('holidays.index')->with('success', 'Festivo actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        //
    }
}
