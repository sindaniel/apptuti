@extends('layouts.admin')


@section('content')



<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
    <div class="w-full">
        <div class="">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl ">Compra #{{ $order->id }}</h1>
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
                                Producto
                            </th>
                          
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Combinaciones
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Precio
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Cantidad
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Descuento
                            </th>

                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                Total
                            </th>

                    


                        
                        </tr>
                    </thead>
                    <tbody class="bg-white ">
                        @foreach ($order->products as $product)
                            <tr class="hover:bg-gray-100 ">
                            
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                    <div class='flex flex-col'>
                                        <span>{{ $product->product->name }}</span>
                                        @if ( $product->product->variation)
                                            <small>
                                                {{ $product->product->variation->name }}:
                                                {{ App\Models\VariationItem::find($product->pivot->variation_id)->name }}
                                            </small>
                                        @endif
    
                                    </div>
                                </td>

                            


                                <td class="px-4 py-2 text-xs font-normal text-gray-500 whitespace-nowrap">
                                    {{-- @if ($product->combinations->count())
                                        <ul>
                                            @foreach ($product->combinations as $p)
                                                <li>{{ $p->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif --}}
                                </td>

                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                    ${{ number_format($product->price, 2) }}
                                </td>

                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                {{$product->quantity}}
                                </td>


                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                    ${{ number_format($product->discount, 2) }}
                                </td>


                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                    ${{ number_format($product->price * $product->quantity, 2) }}
                                </td>

                            </tr>  
                        @endforeach
            

                        <tr>
                            <td colspan="4">

                            </td>
                            <td class='p-4 text-base font-medium text-gray-900 whitespace-nowrap text-right'>Descuento</td>
                            <td class='p-4 text-base font-bold text-gray-900 whitespace-nowrap text-left'>${{ number_format($order->discount, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">

                            </td>
                            <td class='p-4 text-base font-medium text-gray-900 whitespace-nowrap text-right'>Total</td>
                            <td class='p-4 text-base font-bold text-gray-900 whitespace-nowrap text-left'>${{ number_format($order->total, 2) }}</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@if($order->bonifications->count())
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
        <div class="w-full">
            <div class="">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl ">Bonificaciones</h1>
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
                                    Producto
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                    Bonificación
                                </th>
                            
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase ">
                                    Cantidad
                                </th>                        
                            </tr>
                        </thead>
                        <tbody class="bg-white ">
                            @foreach ($order->bonifications as $bonification)
                                <tr class="hover:bg-gray-100 ">
                                    <td class="px-4 py-2  font-normal text-gray-500 whitespace-nowrap">
                                        {{ $bonification->product->name }}
                                    </td>
                                    <td class="px-4 py-2  font-normal text-gray-500 whitespace-nowrap">
                                        {{ $bonification->bonification->name }}
                                    </td>
                                    <td class="px-4 py-2  font-normal text-gray-500 whitespace-nowrap">
                                        {{ $bonification->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif









@endsection
