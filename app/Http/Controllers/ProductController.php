<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tax;
use Illuminate\Http\Request;

use Illuminate\Support\Str as Str;
use Closure;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query()
        ->with('tax')
        ->when($request->q, function($query, $q){
            $query->where('name', 'like', "%{$q}%")
                ->orWhere('sku', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->orWhere('short_description', 'like', "%{$q}%");
        })
        ->orderBy('name')
        ->paginate();
       
        $context = compact('products'); 
        
        return view('products.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $taxes = Tax::orderBy('name')->get()->pluck('name', 'id');
        $context = compact('brands', 'taxes');
        return view('products.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validate = $request->validate([
            'name' => [
                'required', 
                'max:255',
                function (string $attribute, $value, Closure $fail){
                    $slug =  Str::slug($value);
                    $p = Product::where('slug', $slug)->first();
                    if($p){
                        $fail('El slug para este nombre ya existe');
                    }
                },
            ],
            'description' => 'nullable',
            'short_description' => 'nullable',
            'sku' => 'required',
            'active' => 'nullable|boolean',
            'price' => 'required',
            'delivery_days' => 'required',
            'discount' => 'required|numeric',
            'quantity_min' => 'required|numeric',
            'quantity_max' => 'required|numeric',
            'step' => 'required|numeric',
            'tax_id' => 'required',
            
            
        ]);

        $brands = $request->brands;

        $slug =  Str::slug($request->name);
        $validate['slug'] = $slug;

        $product = Product::create($validate);
        $product->brands()->attach($brands);

        return redirect()->route('products.index')->with('success', 'Producto creado');


        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load('brands'); // eager loading
        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $taxes = Tax::orderBy('name')->get()->pluck('name', 'id');
        
       
        $context = compact('brands', 'taxes', 'product', 'categories');


        return view('products.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'short_description' => 'nullable',
            'sku' => 'required',
            'active' => 'nullable|boolean',
            'price' => 'required',
            'delivery_days' => 'required',
            'discount' => 'required|numeric',
            'quantity_min' => 'required|numeric',
            'quantity_max' => 'required|numeric',
            'step' => 'required|numeric',
            'tax_id' => 'required',
            'slug' => [
                'required',
                function (string $attribute, $value, Closure $fail) use($product){
                    $slug =  Str::slug($value);
                    $p = Product::whereNot('id', $product->id)->where('slug', $slug)->first();
                    if($p){
                        $fail('El slug ya existe');
                    }
                },
            ]
        ]);

        $validate['slug'] =  Str::slug($request->slug);

        $product->brands()->sync($request->brands);
        $product->categories()->sync($request->categories);

        $product->update($validate);
       # return back()->with('success', 'Producto actualizado');

        return to_route('products.index')->with('success', 'Producto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //TODO validar que no tenga pedidos
    }
}
