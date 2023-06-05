<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $variations = Variation::query()
        ->when($request->q, function($query, $q){
            $query->where('name', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();
       
        $context = compact('variations'); 
        
        return view('variations.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('variations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' =>'required|max:255',
        ]);

        $variation = Variation::create($validate);

        return to_route('variations.edit', $variation)->with('success', 'La variación se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variation $variation)
    {   
        $variation->load('items');
        $context = compact('variation');
        return view('variations.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variation $variation)
    {
        $validate = $request->validate([
            'name' =>'required|max:255',
        ]);

        $variation->update($validate);

        return to_route('variations.edit', $variation)->with('success', 'La variación se ha actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variation $variation)
    {
        //TODO eliminar variación
    }
}
