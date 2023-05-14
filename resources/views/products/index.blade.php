@extends('layouts.admin')


@section('content')


<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl ">Productos</h1>
        </div>
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 ">
            <div class="flex items-center mb-4 sm:mb-0">
               <x-search :home="route('products.index')" />
            </div>
            <a href="{{ route('products.create') }}"
                class="text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 ">
                Nuevo producto
            </a>
        </div>
    </div>
</div>
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed ">
                    <thead class="bg-gray-100">
                        <tr>
                           
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Nombre
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                SKU
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Precio
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Impuesto
                            </th>

                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Estado
                            </th>
                          
                           
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 ">

                        <tr class="hover:bg-gray-100">
                            @foreach ($products as $product)
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                <a class="flex flex-col text-gray-900  hover:text-blue-500" href="{{ route('products.edit', $product) }}">
                                    <span class="text-base font-semibold ">
                                        {{ $product->name }}
                                    </span>
                                    <span class="text-sm font-normal text-gray-500 ">
                                        {{ $product->slug }}
                                    </span>
                                </a>
                            </td>
                            <td class="p-4 text-xs  text-gray-900 whitespace-nowra">
                                {{ $product->sku }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                
                                @if ($product->discount)
                                    <div class="flex flex-col">
                                        <span>
                                            ${{ number_format($product->price * (1 - $product->discount/100),2) }}
                                            <small class="text-gray-500">({{ $product->discount }}%)</small>
                                        </span>
                                        <small class="line-through">${{ number_format($product->price,2) }}</small>
                                    </div>
                                    
                                @else
                                ${{ number_format($product->price,2) }}
                                @endif
                            </td>

                            <td class="p-4 text-base  text-gray-900 whitespace-nowra">
                               {{$product->tax->name}} <small>({{$product->tax->tax}}%)</small>
                            </td>
                            <td class="p-4 text-base  text-gray-900 whitespace-nowra">
                                <div class="flex items-center">
                                    <div @class([
                                        'inline-block w-4 h-4 mr-2 rounded-full', 
                                        'bg-green-700' => $product->active,
                                        'bg-red-700' => !$product->active
                                        ])></div>
                                    {{ $product->active ? 'Activo' : 'Inactivo' }}
                                </div>
                            </td>
                           

                            <td class="p-4 space-x-2 whitespace-nowrap text-end">

                                <a href="button" class="inline-flex   items-center space-x-2 text-green-400 hover:text-white border border-green-400 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 text-center mr-2 mb-2 ">
                                    <x-heroicon-o-pencil-square class="h-4 w-4"/>
                                    <span>Imagenes</span>
                                </a>

                                <a href="{{ route('products.edit', $product) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 border border-blue-700  space-x-2">
                                    <x-heroicon-o-pencil-square class="h-4 w-4"/>
                                    <span>Editar</span>
                                </a>
                              
                            </td>
                        </tr>

                        @endforeach
            


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


{{ $products->links() }} 











@endsection
