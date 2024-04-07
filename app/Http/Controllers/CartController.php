<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessOrder;
use App\Mail\NewOrderEmail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductBonification;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){

        
        $cart = session()->get('cart');
        
        if(!$cart){
            return redirect()->route('home');
        }

        $products = [];
        
        foreach($cart as $item){
            $product = Product::with('brand')->find($item['product_id']);
            $product->quantity = $item['quantity'];
            $product->vendor_id = $product->brand->vendor->id;
            $products[] = $product;
        }
        $products = collect($products);

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

    public function add(Request $request, Product $product){
       

        $request->validate([
            'variation_id'=> 'nullable|numeric',
            'quantity' => 'required|numeric',
        ]);

        $cart = session()->get('cart');
        
        if(!$cart){
            $cart = [
                $product->id => [
                    "product_id" => $product->id,
                    "quantity" => $request->quantity,
                    "variation_id" => $request->variation_id,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
        }



        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Producto agregado al carrito exitosamente!');
        }else{

        }
            
        $cart[$product->id] = [
            "product_id" => $product->id,
            "quantity" => $request->quantity,
            "variation_id" => $request->variation_id,
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


    public function processOrder(Request $request){


        $cart = session()->get('cart');

      

        $total = 0;
        $discount = 0;


        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total' => $total,
            'discount' => $discount,
        ]);



        foreach ($cart as $key => $product) {
            
            $id = $product['product_id'];

            $p = Product::find($id);

            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $product['quantity'],
                'price' => $p->finalPrice['price'],
                'discount' => $p->finalPrice['totalDiscount'],
                'variation_id' => $product['variation_id'] ?? null,
            ]);


            $bonification = $p->bonifications->first();
            if($bonification){
                //  floor($product->pivot->quantity / $product->bonifications->first()->buy)
                $bonification_quantity = floor($product['quantity'] / $bonification->buy);
                if($bonification_quantity > $bonification->max){
                    $bonification_quantity = $bonification->max;
                }

                OrderProductBonification::create([
                    'bonification_id' => $bonification->id,
                    'order_product_id' => $orderProduct->id,
                    'product_id' => $bonification->product_id,
                    'quantity' => $bonification_quantity,
                    'order_id' => $order->id,
                ]);
                   
            }


            $total = $total + ($p->finalPrice['price'] * $product['quantity']);
            $discount = $discount + ($p->finalPrice['totalDiscount'] * $product['quantity']);      

        }


        $order->update([
            'total' => $total,
            'discount' => $discount,
        ]);

        dd($order);


        dispatch(new ProcessOrder($order));
        new NewOrderEmail($order);
        
        return to_route('home')->with('success', 'Compra procesada con exito!');

    }

}
