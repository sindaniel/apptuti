<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{   
    public function home()
    {
       
        return view('pages.home');
    }

    public function category($slug, $slug2=null)
    {

     
      
        if($slug2){

            $category = Category::with('parent')->where('slug', $slug2)->firstOrFail();
            $products = $category->products()->paginate(1);

        }else{

            $category = Category::where('slug', $slug)->firstOrFail();
            $products = $category->products()->paginate();

            //seleccion el id de las categorias padres 
            $ids = $category->children->pluck('id')->toArray();

            $ids = array_merge($ids, [$category->id]);
            
            $products = Product::whereHas('categories', function($query) use ($ids){
                $query->whereIn('category_id', $ids);
            })->paginate(1);

          
        
            
        }

    
        $context = compact('category', 'products');

        return view('pages.category', $context);
       
    }

    public function product($slug)
    {
        $product = Product::query()
        ->with(['related'])->with(['labels' => function($query) {
            $query->where('active', 1); 
        }])
        ->where('slug', $slug)->firstOrFail();
        $context = compact('product');
        return view('pages.product',  $context);
    }


    public function label($slug){
        $label = Label::whereActive(1)->where('slug', $slug)->firstOrFail();
        $products = $label->products()->paginate();
        $context = compact('label', 'products');
        return view('pages.label', $context);
    }

    public function brands(){
        $brands = Brand::whereActive(1)->orderBy('name')->get();
        $context = compact('brands');
        return view('pages.brands', $context);
    }


    public function brand($slug){
        $brand = Brand::whereActive(1)->where('slug', $slug)->firstOrFail();
        $products = $brand->products()->paginate();
        $context = compact('brand', 'products');
        return view('pages.brand', $context);
    }
}
