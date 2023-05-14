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


                        <button type="button" id="deleteProductButton"
                            data-drawer-target="drawer-delete-product-default"
                            data-drawer-show="drawer-delete-product-default"
                            aria-controls="drawer-delete-product-default" data-drawer-placement="right"
                            class="flex items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 text-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                            </svg>
                            <span>Eliminar vendor</span>
                        </button>
                    
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








<div id="drawer-delete-product-default"
    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white"
    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label"
        class="inline-flex items-center text-sm font-bold text-gray-500 uppercase ">Eliminar vendor
    </h5>
    <button type="button" data-drawer-dismiss="drawer-delete-product-default"
        aria-controls="drawer-delete-product-default"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <svg class="w-10 h-10 mt-8 mb-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="mb-6 text-lg text-gray-500 ">¿Está seguro de que desea eliminar este vendor?</h3>
  
    <div class="flex">
        {{ Aire::open()->route('vendors.destroy', $vendor) }}
            {{ Aire::button('Si, estoy seguro')->variant()->red() }}
        {{ Aire::close() }}


        <button href="#"
            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center "
            type="button" data-drawer-dismiss="drawer-delete-product-default"
        aria-controls="drawer-delete-product-default">
            No, cancelar
        </button>

    </div>
    
</div>


@endsection
