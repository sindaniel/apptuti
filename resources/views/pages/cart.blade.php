@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>'Carrito de compras', 
        'description'=> 'Carrito de compras'
        ])
@endsection



@section('content')
    

<div class="w-full">
    <h1 class="text-3xl mb-5">Carrito</h1>
</div>




<div class="relative overflow-hidden bg-white shadow-md  sm:rounded-lg w-full">
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>       
                    <th scope="col" class="px-4 py-3 w-10"></th>
                    <th scope="col" class="px-4 py-3">Producto</th>
                    <th scope="col" class="px-4 py-3">Precio</th>
                    <th scope="col" class="px-4 py-3 w-48">Cantidad</th>
                    <th scope="col" class="px-4 py-3 text-right">Subtotal</th>
                
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDiscount = 0;
                    $total = 0
                @endphp
                @foreach ($products as $product)
                
                    @php
                        $totalDiscount += $product->finalPrice['totalDiscount']* $product->quantity;
                        $total += $product->finalPrice['price']* $product->quantity;
                    @endphp
                    
                    <tr class="border-b ">
                    

                        <td  class=" px-4 py-2 ">

                            <form action="{{ route('cart.remove') }}" method="post">

                                @method('DELETE')
                                @csrf
                                <input type="hidden" name='product_id' value="{{ $product->id }}">
                                <button  class='hover:text-red-500'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>                              
                                </button>
                            </form>

                            
                        </td>


                        <td scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <a class="flex items-center" href="{{route('product', $product->slug)}}">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png" class="w-auto h-8 mr-3">
                            <span>{{ $product->name }}</span>
                            </a>
                        </td>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded">
                                {{-- <small class='line-through' >${{ $product->finalPrice['old'] }}</small>
                                <span>${{ $product->finalPrice['price'] }}</span> --}}
                                <x-price :product='$product' />
                            </span>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name='product_id' value="{{ $product->id }}">
                                {{ Aire::input('quantity')->value($product->quantity) }}
                            </form>
                        </td>

                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap text-right">
                            <strong id='price'>${{ currency($product->finalPrice['price'] * $product->quantity, 0)}}</strong>   
                        </td>

                        


                    
                        
                    </tr>
                @endforeach
                
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4" class='px-4 py-2 text-xl'>
                        
                        <div class='text-right '>
                            Ahorro total
                        </div>

                    </td>
                    <td  class='px-4 py-2 text-xl text-right'>
                        ${{ currency($totalDiscount)  }}
                    </td>
                </tr>

                <tr>
                    <td colspan="4" class='px-4 py-2 text-xl'>
                        
                        <div class='text-right '>
                            Subtotal
                        </div>

                    </td>
                    <td  class='px-4 py-2 text-xl text-right'>
                        ${{ currency($total)  }}
                    </td>
                </tr>

                <tr class='text-black font-bold'>
                    <td colspan="4" class='px-4 py-2 text-xl' >
                        
                        <div class='text-right '>
                            Total
                        </div>

                    </td>
                    <td  class='px-4 py-2 text-xl text-right'>
                        ${{ currency($total)  }}
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class='px-4 py-2 text-xl' >


                        @forelse ($alertVendors as $vendor)

                            <div class='text-red-500'>
                                
                                El vendor   {{ $vendor->name }} require de un pedido mínimo de ${{ currency($vendor->minimum_purchase) }}, se compraron: ${{ currency($vendor->current) }}
                            </div>
                                
                        @empty
                        

                            <div class="flex justify-end">
                                @auth
                                <button type="button" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Comprar</button>
                                @else
                                <a href="{{ route('register') }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 ">Registrarme y Comprar</a>
                                @endauth
                                


                            </div>

                        @endforelse
                        
                      
                    </td>
                
                </tr>
            </tfoot>
        </table>
    </div>

</div>







@endsection


