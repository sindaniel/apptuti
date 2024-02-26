<?php

namespace App\Http\Controllers\Shopper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('shopper.pages.home');
    }

    public function products()
    {
        return view('shopper.pages.products');
    }


    public function cart()
    {
        return view('shopper.pages.cart');
    }


    public function orders()
    {
        return view('shopper.pages.orders');
    }

    public function order($id)
    {
        return view('shopper.pages.order');
    }


    public function contact()
    {
        return view('shopper.pages.contact');
    }


    public function reports()
    {
        return view('shopper.pages.reports');
    }


}
