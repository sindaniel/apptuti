<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use App\Models\VariationItem;
use Illuminate\Http\Request;

class VariationItemController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Variation $variation)
    {
        $request->validate([
            'item_name' =>'required|max:255',
        ]);
        
        $variation->items()->create([
            'name'=>$request->item_name
        ]);

        return to_route('variations.edit', $variation)->with('success', 'el item se ha creado correctamente');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variation $variation, VariationItem $item)
    {
        $item->update($request->all());

        return to_route('variations.edit', $variation)->with('success', 'el item se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //TODO eliminar item variación
    }
}
