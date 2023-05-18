<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Label;
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
            ->when($request->q, function ($query, $q) {
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
        $brands = Brand::orderBy('name')->get()->pluck('name', 'id');
        $brands->prepend('Seleccione', null);
        $taxes = Tax::orderBy('name')->get()->pluck('name', 'id');
        $labels = Label::orderBy('name')->get();
        $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();
        $context = compact('brands', 'taxes', 'labels', 'categories');
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
                function (string $attribute, $value, Closure $fail) {
                    $slug =  Str::slug($value);
                    $p = Product::where('slug', $slug)->first();
                    if ($p) {
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
            'brand_id' => 'required',


        ]);

        $brands = $request->brands;
        $categories = $request->categories;
        $labels = $request->labels;

        $slug =  Str::slug($request->name);
        $validate['slug'] = $slug;

        $product = Product::create($validate);
       
        $product->labels()->attach($labels);
        $product->categories()->attach($categories);

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
        $product->load(['brand', 'related']); // eager loading

        $brands = Brand::orderBy('name')->get()->pluck('name', 'id');
        $brands->prepend('Seleccione', null);

        $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();
        $labels = Label::orderBy('name')->get();
        $taxes = Tax::orderBy('name')->get()->pluck('name', 'id');

        $context = compact('brands', 'taxes', 'product', 'categories', 'labels');


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
            'brand_id' => 'required',
            'slug' => [
                'required',
                function (string $attribute, $value, Closure $fail) use ($product) {
                    $slug =  Str::slug($value);
                    $p = Product::whereNot('id', $product->id)->where('slug', $slug)->first();
                    if ($p) {
                        $fail('El slug ya existe');
                    }
                },
            ]
        ]);

        $validate['slug'] =  Str::slug($request->slug);

        $product->labels()->sync($request->labels);
        $product->categories()->sync($request->categories);

        $product->update($validate);
        # return back()->with('success', 'Producto actualizado');

        return to_route('products.index')->with('success', "Producto actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //TODO validar que no tenga pedidos
    }



    public function search(Request $request)
    {
        $products = Product::query()
            ->select('name as text', 'id')
            ->when($request->product_id, function ($query, $p) {
                $product = Product::find($p);
                $query
                    ->whereNot('id', $p)
                    ->whereNotIn('id', $product->related->pluck('id'));
            })
            ->when($request->q, function ($query, $q) {
                $query->whereNot(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->where('sku', 'like', "%{$q}%")
                        ->where('description', 'like', "%{$q}%")
                        ->where('short_description', 'like', "%{$q}%");
                });
            })

            ->orderBy('name')
            ->limit(10)
            ->get();

        return $products;
    }


    public function addRelated(Request $request, Product $product)
    {
        $product->related()->attach($request->related_id);
        return;
    }

    public function removeRelated(Request $request, Product $product)
    {

        $product->related()->detach($request->related_id);
        return;
    }
}
