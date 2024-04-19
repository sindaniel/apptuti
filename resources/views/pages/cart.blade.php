@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>'Carrito de compras', 
        'description'=> 'Carrito de compras'
        ])
@endsection



@section('content')
    


<div class="grid grid-cols-1 w-full gap-y-5 gap-x-5 xl:px-72"  x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">

    <div class="">

        @if($alertVendors)
            <div class="space-y-2 mb-5">
                @foreach ($alertVendors as $alert)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        El vendor <strong>{{$alert->name}}</strong> requiere una compra mínima de <strong>${{currency($alert->minimum_purchase)}}</strong> para realizar el pedido compra <strong>${{currency($alert->minimum_purchase - $alert->current)}}</strong> completar esta compra.
                    </div>
                @endforeach  
            </div> 
        @endif   
  


        <div class="border rounded p-5">
            <div>
                <h3 class="mb-4">Productos</h3>
                <div class="xl:text-base text-sm">
                    @foreach ($products as $product)
                        <div class="grid grid-cols-12 items-top gap-x-2">
                            <a href="{{route('product', $product->slug)}}" class="col-span-2">
                                <img src="{{asset('storage/'.$product->image)}}" alt="">  
                            </a>
                            <div class="col-span-7 px-3 flex flex-col">
                                <a href='{{route('product', $product->slug)}}'>{{$product->name}} ({{$product->quantity}})</a>
                                <small class="text-slate-700">${{currency($product->final_price['old'])}}</small>
                                @if($product->variation)
                                    <small class="text-slate-700">{{$product->variation->name}}  {{$product->item->name}}</small>
                                @endif
                            </div>
                            <div class="col-span-2 text-right">
                                <strong class="">${{currency($product->final_price['price'] * $product->quantity)}}</strong>
                                @if($product->final_price['has_discount'])
                                    <small class="line-through">${{currency($product->final_price['old'] * $product->quantity)}}</small>
                                @endif
                            </div>    
                            {{ Aire::open()->route('cart.remove')->class('items-start justify-center flex')}}
                                <input type="hidden" name='product_id' value="{{ $product->id }}">
                                <button  class='hover:text-red-500 text-slate-400 mt-1'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>                              
                                </button>
                            {{ Aire::close() }}                            
                        </div>
                    @endforeach
                </div>

                <div class="text-sm">
                    <hr class="my-4">

                    @php
                        $subtotal = $products->sum(function($product){
                            return $product->final_price['old'] * $product->quantity;
                        });

                        $discount = $products->sum(function($product){
                            return $product->final_price['totalDiscount'] * $product->quantity;
                        });
                    @endphp

           
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <strong>
                           ${{currency($subtotal)}}
                        </strong>
                    </div>
                    @if($discount)
                        <div class="flex justify-between">
                            <span>Descuento</span>
                            <strong>
                                -${{currency($discount)}}
                            </strong>
                        </div>
                    @endif
                    <hr class="my-4">
                    <div class="flex justify-between">
                        <strong>Total</strong>
                        <strong>${{currency($subtotal-$discount)}}</strong>
                    </div>

                  
                    @if($alertVendors)
                        <button disabled class="bg-orange-600 opacity-50 w-full text-white rounded py-3 px-5 mt-5 block text-center">Realizar Pedido</button>
                    @else 
                       {{ Aire::open()->route('cart.process')}}

                         <div class="pt-5">
                            {{ Aire::select($zones, 'zone_id', 'Dirección')->id('states')}}
                        </div>



                            <button type="submit" class="bg-orange-600 w-full text-white rounded py-3 px-5 mt-5 block text-center hover:bg-orange-900">Realizar Pedido</button> 
                        {{ Aire::close() }}
                        
                    @endif


                </div>
            
                    

            </div>
        </div>
    </div>


</div>





@endsection


