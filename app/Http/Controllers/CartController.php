<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        
        $cart = session()->get('cart');

        if( !$cart){
            return redirect()->route('home');
        }

        $products = [];
        
        foreach($cart as $item){
            $product = Product::with('brand.vendors')->find($item['product_id']);
            $product->quantity = $item['quantity'];
            $product->vendor_id = $product->brand->vendors->first()->id;
            $products[] = $product;
        }


        //compra minima por vendor
        $byVendors = collect($products)->groupBy('vendor_id');
        $alertVendors = [];
        foreach ($byVendors as $key => $vendor) {
            $total = $vendor->sum(function ($product) {
                return $product->quantity * $product->finalPrice['price'];
            });
            
            $v = Vendor::find($key);
                
            if($total < $v->minimum_purchase){
                $v->current = $total;
                $alertVendors[] = $v;
            }
        }

      

        $context = compact('products', 'alertVendors'); 
        
        return view('pages.cart', $context);


      
    }

    public function add_guest(Request $request){
        $request->validate([
            'product_id' => 'required|numeric',
            'variation_id'=> 'nullable|numeric',
            'quantity' => 'required|numeric',
        ]);

        $cart = session()->get('cart');
    
        if(!$cart){
            $cart = [
                $request->product_id => [
                    "product_id" => $request->product_id,
                    "quantity" => $request->quantity,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
        }

        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
        }

        $cart[$request->product_id] = [
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
    }


    public function remove(Request $request){
        $request->validate([
            'product_id' => 'required|numeric',
        ]);

        $cart = session()->get('cart');
    
        if(isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito exitosamente!');
    }


    public function update(Request $request){
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $cart = session()->get('cart');
    
        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto actualizado exitosamente!');
    }

}
