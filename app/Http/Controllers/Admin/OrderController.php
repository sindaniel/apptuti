<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    public function index(){

        $orders = Order::with(['user', 'products'])->orderByDesc('id')->paginate();
        $context = compact('orders');

        return view('orders.index', $context );
    }

    public function edit(Order $order){
        $order->load([
            'user',
            'products'=>[
                'variation', 
                'bonifications.product'
                ] ]);
        $context = compact('order');
        return view('orders.edit', $context);
    }

}
