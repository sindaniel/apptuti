<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessOrder;
use App\Mail\NewOrderEmail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductBonification;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\OrderRepository;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
       
        
        
        $cart = session()->get('cart');
        
        if(!$cart){
            return redirect()->route('home');
        }
        
        $user = auth()->user();
        $zones = $user->zones->pluck('address', 'id')->toArray();

        $set_user = false;
        $client = null;
        if($user->hasRole('seller')){
            $user_id = session()->get('user_id');
            $set_user = true;
            if($user_id){
                $client = User::with('zones')->find($user_id);
                $zones = $client->zones->pluck('address', 'id')->toArray();
                $set_user = false;
            }
        }

        $products = [];
        
        foreach($cart as $item){
            
            $product = Product::with('brand', 'variation')->find($item['product_id']);
            
            $product->item = $product->items->where('id', $item['variation_id'])->first();
                
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

        
        
        $context = compact('products', 'alertVendors', 'zones', 'set_user', 'client'); 
        
        return view('pages.cart', $context);


      
    }

    public function add(Request $request, Product $product){

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        

       

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
            return to_route('cart')->with('success', 'Producto agregado al carrito exitosamente!');
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

     //   dd($request->all());
        $cart = session()->get('cart');
    
        $total = 0;
        $discount = 0;

        $user = auth()->user();
       
        $seller_id = null;
        $user_id = $user->id;
        
        if($user->hasRole('seller')){
            $seller_id = $user->id;
            $user_id = session()->get('user_id');
        }

        $delivery_date = OrderRepository::getBusinessDay(); 
        

        $order = Order::create([
            'user_id' => $user_id,
            'total' => $total,
            'discount' => $discount,
            'zone_id' => $request->zone_id,
            'seller_id' => $seller_id,
            'delivery_date' => $delivery_date,
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
                'variation_item_id' => $product['variation_id'] ?? null,
                'percentage' => $p->finalPrice['discount'] ?? 0,
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

        //if env production
        if(app()->environment('production')){
            session()->forget('cart');
        }

        session()->forget('user_id');

    
        OrderRepository::presalesOrder($order);
        return to_route('home')->with('success', 'Compra procesada con exito!');
    
        // return to_route('home')->with('success', 'Es necesario tener un codigo de cliente para procesar la compra, contacta al administrador!');

        // dispatch(new ProcessOrder($order));
        // new NewOrderEmail($order);
        

    }

}
