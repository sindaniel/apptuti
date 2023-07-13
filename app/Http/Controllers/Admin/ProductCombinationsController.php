<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductCombinationsController extends Controller
{
    

    public function store(Request $request, Product $product){

        $combined = Product::with('variation', 'items')->find($request->product_id);
        $price = $combined->price;
        $variation_item_id = null;

        
        if($combined->items->count()){
            $price = $combined->items->first()->pivot->price;
            $variation_item_id = $combined->items->first()->id; 
        }


        $product->combinations()->attach(
            $request->product_id,
            [
                'price'=>$price,
                'variation_item_id'=>$variation_item_id,
            ]
        );
        return to_route('products.edit', $product)->withFragment('combined')->with('success', 'Producto agregado');

    }



    public function update(Request $request, Product $product, $combination){

        $product->combinations()->detach();

        
      
        foreach ($request->combined as $key => $combined) {
            
         
            $product->combinations()->attach(
                $key,
                [
                    'price'=>$combined['price'],
                    'variation_item_id'=>@$combined['variation_item_id'],
                ]
            );
        }

        $total = collect($request->combined)->sum('price');

        $product->update([
            'price'=>$total
        ]);

        return to_route('products.edit', $product)->withFragment('combined')->with('success', 'Productos actualizados');
      

     // 

    }

    public function remove_combination(Product $product, $id){
        $product->combinations()->detach($id);
        return to_route('products.edit', $product)->withFragment('combined')->with('success', 'Producto eliminado');
    }




}
