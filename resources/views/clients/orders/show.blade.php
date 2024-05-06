@extends('layouts.page')


@section('head')

    @include('elements.seo', ['title'=>'Ordenes' ])

@endsection


@section('content')
    
<section class="w-full xl:px-5 px-0">
   
<h2 class="text-2xl font-bold mb-5">Orden #{{$order->id}}</h2>

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
                          
                                        </div>
                                    </td>

                                


                                  

                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                        ${{ number_format($product->price+$product->discount, 2) }}
                                    </td>

                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                    {{$product->quantity}}
                                    </td>


                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                        ${{ number_format($product->discount * $product->quantity, 2) }}
                                    </td>


                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowra">
                                        ${{ number_format($product->price * $product->quantity, 2) }}
                                    </td>

                                </tr>  
                            @endforeach
                

                            <tr>
                                <td colspan="3">

                                </td>
                                <td class='p-4 text-base font-medium text-gray-900 whitespace-nowrap text-right'>Descuento</td>
                                <td class='p-4 text-base font-bold text-gray-900 whitespace-nowrap text-left'>${{ number_format($order->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">

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
</section>






@endsection


@section('scripts')
 

@endsection