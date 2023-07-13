<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $taxes = Tax::query()
        ->when($request->q, function($query, $q){
            $query->where('name', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();
       
        $context = compact('taxes'); 
        
        return view('taxes.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'tax'=> 'required|numeric|min:0|max:100',
        ]);

        Tax::create($validate);

        return to_route('taxes.index')->with('success', 'Impuesto creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        $context = compact('tax');
        return view('taxes.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tax $tax)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'tax'=> 'required|numeric|min:0|max:100',
        ]);

        $tax->update($validate);

        return to_route('taxes.index')->with('success', 'Impuesto actualizado');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        //TODO validar que no tenga productos asociados
    }
}
