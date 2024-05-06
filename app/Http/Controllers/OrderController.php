<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){


        $user = auth()->user();

        $orders = Order::with('user')->withCount('products')->whereBelongsTo($user)->orwhere('seller_id', $user->id)->orderByDesc('id')->paginate();

        $context = compact('orders');

        return view('clients.orders.index', $context);
    }

    public function show($id){


        $user = auth()->user();

        $order = Order::query()
            ->with('user')
            ->withCount('products')
            ->whereBelongsTo($user)
            ->orwhere('seller_id', $user->id)
            ->orderByDesc('id')
            ->first();

        if(!$order){
            return redirect()->route('clients.orders.index');
        }

        $context = compact('order');

        return view('clients.orders.show', $context);

      
    }
}
