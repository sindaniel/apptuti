@extends('layouts.admin')


@section('content')

<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Editar vendor</h1>
    </div>
    <!-- Right Content -->
   
    <div class="col-span-2">
        {{ Aire::open()->route('vendors.update', $vendor)->bind($vendor)->enctype('multipart/form-data')}}
            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
                <h3 class="mb-4 text-xl font-semibold ">Información</h3>
                

                <div class="grid grid-cols-6 gap-6">
                    {{ Aire::input('name', "Nombre")->placeholder('Nombre')->groupClass('col-span-6 sm:col-span-3') }}
                    {{ Aire::input('slug', "Slug")->placeholder('Slug')->groupClass('col-span-6 sm:col-span-3') }}
                    {{ Aire::number('minimum_purchase', "Compra mínima")->placeholder('Compra mínima')->groupClass('col-span-6') }}

                    <div>
                        {{ Aire::hidden('active')->value(0)}}
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input @checked($vendor->active) type="checkbox" name='active' value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all0 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 ">Activo</span>
                        </label>
                    </div>

                </div>
    
            </div>

            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
                <h3 class="mb-4 text-xl font-semibold ">Imágenes</h3>
                

                <div class="grid grid-cols-2 gap-5">
                    <div class="flex flex-col justify-end">
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/'.$vendor->image) }}" alt="" class="w-48 inline-block">
                        </div>
          
                        {{ Aire::file('image_file', 'Imagen') }}
                    </div>
    
                    <div class="flex  flex-col justify-end">
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/'.$vendor->banner) }}" alt="" class="w-48 inline-block">
                        </div>
                        {{ Aire::file('banner_file', 'Banner') }}
                    </div>
                </div>
            </div>


            <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            
                <div class="grid grid-cols-6 gap-6">         
                    <div class="col-span-6 justify-between  items-center  space-x-2 flex">

                        <p class="flex space-x-2 items-center">
                            {{ Aire::submit('Actualizar')->variant()->submit() }}
                            <a href="{{ route('vendors.index') }}">Cancelar</a>
                        </p>


                        <x-remove-button />  
                    
                    </div>
                </div>

                
            </div>
        {{ Aire::close() }}
    </div>
    
    <div class="col-span-full xl:col-auto">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Marcas</h3>
            {{ Aire::open()->route('vendors.addBrand', $vendor)}}
                <div class="grid grid-cols-6 gap-6">
                    {{  Aire::select($brands, 'brand_id')->groupClass('col-span-4')}}
                    {{ Aire::button('Agregar')->variant()->submit()->addClass('col-span-2') }} 
                </div>
            {{ Aire::close() }}  


            <div class="relative overflow-x-auto  mt-5">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">Marca</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendor->brands as $brand)
                            <tr class="bg-white border-b ">

                                <td class="px-6 py-4">
                                    <a href="{{ route('brands.edit', $brand) }}" class="text-reset" tabindex="-1">{{ $brand->name }}</a>
                                </td>
            
                                            
                                <td class="px-6 py-4 text-end">
                                    {{ Aire::open()->route('vendors.removeBrand', [$vendor, 'brand_id'=>$brand->id])->delete()->class('d-inline-block')}}
                                        <button class="text-red-500 text-small">Eliminar							  </button>
                                    {{ Aire::close() }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

<x-remove-drawer title="Vendor" route='vendors.destroy' :item='$vendor' />


@endsection
