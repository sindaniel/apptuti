<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vendors = Vendor::query()
            ->when($request->q, function($query, $q){
                $query->where('name', 'like', "%{$q}%");
            })
            ->withCount('brands')
            ->orderBy('name')
            ->paginate();
            
        $context = compact('vendors'); 
        
        return view('vendors.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'minimum_purchase'=> 'required|numeric',
            'discount'=>'numeric',
            'active'=>'nullable',
        ]);

        

        $validate['slug'] =  Str::slug($request->name);

        if($request->hasFile('image_file')){
            $validate['image'] = $request->image_file->store('/vendors', 'public');
        }

        if($request->hasFile('banner_file')){
            $validate['banner'] = $request->banner_file->store('/vendors', 'public');
        }
        
        Vendor::create($validate);

        return to_route('vendors.index')->with('success', 'Vendor creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        $vendor->load('brands');
        $brands = $vendor->brands;
        $brands = Brand::orderBy('name')->get();
        

        $context = compact('vendor', 'brands'); 
        
        return view('vendors.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'minimum_purchase'=> 'required|numeric',
            'discount'=>'numeric',
            'slug'=>'required|unique:brands,slug,'.$vendor->id,
            'active'=>'nullable',
        ]);
        
        //save file
        if($request->hasFile('image_file')){
            $validate['image'] = $request->image_file->store('/vendors', 'public');
        }

        if($request->hasFile('banner_file')){
            $validate['banner'] = $request->banner_file->store('/vendors', 'public');
        }

        $vendor->brands()->sync($request->brands);

        $validate['slug'] =  Str::slug($request->slug);
        
        $vendor->update($validate);

        return to_route('vendors.index')->with('success', 'Vendor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        if(!$vendor->brands->count()){
            $vendor->delete();
            return to_route('vendors.index')->with('success', 'Vendor eliminado');
        }

        return to_route('vendors.edit', $vendor)->with('error', 'No es posible eliminar el vendor por que tiene marcas asociadas');
        
    }


}
