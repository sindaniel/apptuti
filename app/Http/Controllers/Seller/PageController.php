<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('seller.pages.home');
    }

    public function product()
    {
        return view('seller.pages.product');
    }

    public function cart()
    {
        return view('seller.pages.cart');
    }

    public function orders()
    {
        return view('seller.pages.orders');
    }

    public function order($id)
    {
        return view('seller.pages.order');
    }

    public function faq()
    {
        return view('seller.pages.faq');
    }


    public function contact()
    {
        return view('seller.pages.contact');
    }

}
