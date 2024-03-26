<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Bonification;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tax;
use App\Models\Variation;
use App\Models\VariationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
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

        $variations = Variation::orderBy('name')->get()->pluck('name', 'id');
        $variations->prepend('Seleccione', null);

        $taxes = Tax::orderBy('name')->get()->pluck('name', 'id');
        $labels = Label::orderBy('name')->get();


        $bonifications = Bonification::orderBy('name')->get()->pluck('name', 'id');
        $bonifications->prepend('Seleccione', null);

        $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();

        $context = compact('brands', 'taxes', 'labels', 'categories', 'variations', 'bonifications');
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
            'variation_id'=>'nullable',
            'is_combined' => 'nullable|boolean',
        ]);

        
  
        
        $categories = $request->categories;
        $labels = $request->labels;

        $slug =  Str::slug($request->name);
        $validate['slug'] = $slug;

        $product = Product::create($validate);
       
        $product->labels()->attach($labels);
        $product->categories()->attach($categories, );


        if($request->variation_id){
            $variations = VariationItem::whereVariationId($request->variation_id)->get();
            $product->items()->attach($variations, [
                'price'=> $validate['price'],
                'enabled'=>true
            ]);  
        }
       

        return to_route('products.edit', $product)->with('success', 'Producto creado');
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
        $product->load([
            'brand', 
            'combinations',
            'related', 
            'items' => ['variation'],
            'variation',
            'images',
            'bonifications'
        ]); // eager loading

  

        $brands = Brand::orderBy('name')->get()->pluck('name', 'id');
        $brands->prepend('Seleccione', null);

        $variations = Variation::orderBy('name')->get()->pluck('name', 'id');
        $variations->prepend('Seleccione', null);

        $bonifications = Bonification::orderBy('name')->get()->pluck('name', 'id');
        $bonifications->prepend('Seleccione', null);

        $ids = $product->combinations()->get()->pluck('id')->toArray();
        $id = $product->id;
        $products = Product::query()
            ->with('variation', 'items')
            ->whereNot('id', $id)
            ->whereNotIn('id', $ids)
            ->whereActive(1)
            ->whereIsCombined(0)
            ->select(['name', 'id'])
            ->orderBy('name', 'asc')
            ->get()->pluck('name', 'id');
        $products->prepend('Seleccione', null);

        $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();
        $labels = Label::orderBy('name')->get();
        $taxes = Tax::orderBy('name')->get()->pluck('name', 'id');

        $context = compact('brands', 'taxes', 'product', 'categories', 'labels', 'variations', 'products', 'bonifications');


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
            'variation_id'=>'nullable',
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

        $product->items()->sync($request->variations);

        $product->update($validate);
        # return back()->with('success', 'Producto actualizado');
        if($request->bonification_id){
            $bonification = Bonification::find($request->bonification_id);
            $product->bonifications()->detach();
            $bonification->products()->attach($product->id);
        }else{
            $product->bonifications()->detach();
        }
      

        return to_route('products.index')->with('success', "Producto actualizado");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //TODO validar que no tenga pedidos
    }


    public function images(Request $request, Product $product){

        $validate = $request->validate([
            'image' => 'required|image|max:4096',
        ]);

        $path = $validate['image']->store('products', 'public');

        $product->images()->create([    
            'path' => $path
        ]);

        return back()->with('success', 'Imagen cargada');

    }

    public function images_delete(Request $request, Product $product, ProductImage $image){

        $image->delete();

        return back()->with('success', 'Imagen eliminada');

    }


 


}
