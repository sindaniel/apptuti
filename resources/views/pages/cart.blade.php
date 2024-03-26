@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>'Carrito de compras', 
        'description'=> 'Carrito de compras'
        ])
@endsection



@section('content')
    




<!-- Main modal -->
<div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Static modal
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="static-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div>



<div class="grid grid-cols-12 w-full gap-y-5 gap-x-5"  x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">

    <div class="xl:col-span-8 col-span-12  ">
        <div class="border rounded py-5 xl:px-8 px-4 xl:space-y-0 space-y-5">
            
            <div class="flex space-x-2 items-center">
                <div class="w-6  h-6 p-2 text-xs  rounded-full bg-blue3 text-blue1  flex items-center justify-center">
                    <span>1</span>
                </div>
                <strong>Datos de facturación</strong>
            </div>
            <div class="grid xl:grid-cols-2 grid-cols-1">
                <div class="px-10 xl:py-7 py-3 leading-7">
                    <p>Ana María Correa</p>
                    <p>3017293901</p>
                    <p>c.c 1234567890</p>
                </div>

                <div class="px-10 xl:py-7 py-3 leading-7">
                    <p>ana.correa@dazzet.co</p>
                    <p>Calle 56 Sur #28 - 112</p>
                    <p>Sabaneta</p>
                </div>
                

            </div>


            <div class="flex space-x-2 items-center">
                <div class="w-6  h-6 p-2 text-xs  rounded-full bg-blue3 text-blue1  flex items-center justify-center">
                    <span>2</span>
                </div>
                <strong> Dirección de entrega</strong>
            </div>
            <div class="grid xl:grid-cols-2 grid-cols-1 gap-5 px-10 py-5">

                @for ($i = 0; $i < 2; $i++)
                    <div class="border rounded py-2 px-4 ">
                        <div class="flex items-center space-x-2">
                            <input type="radio">
                            <strong>Tienda 1</strong>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="px-6 py-1 leading-5">
                                <p>Calle 56 Sur #28 - 112</p>
                                <p class="text-gray-500 text-sm">Sabaneta</p>
                            </div>
                            <a href="#" class="bg-blue3 w-7 h-7 rounded-full center">
                                <svg class="w-4 h-4 text-blue1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endfor

                <div class="border rounded ">
                        <div class="flex items-center text-blue1">
                           
                            <a href="#" class="flex space-x-4  py-8 px-4">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <button type="button" data-modal-target="static-modal" data-modal-toggle="static-modal">Añadir dirección</button>
                            </a>
                        </div>
                       
                    </div>

            </div>

           
        </div>
    </div>

     <div class="xl:col-span-4 col-span-12  ">
        <div class="border rounded p-5">
            <div class="flex space-x-2 items-center">
                <div class="w-6  h-6 p-2 text-xs  rounded-full bg-blue3 text-blue1  flex items-center justify-center">
                    <span>3</span>
                </div>
                <strong>Tu pedido</strong>
            </div>

            <div class="">
                <h3 class="my-4">Productos</h3>

                <div class=" text-xs">

                    @foreach ($products as $product)

                     <div class="grid grid-cols-12 items-top gap-x-2">
                            <a href="{{route('product', $product->slug)}}" class="col-span-2">
                                <img src="{{asset('storage/'.$product->image)}}" alt="">  
                            </a>
                            <div class="col-span-8 px-3 flex flex-col">
                                <a href='{{route('product', $product->slug)}}'>{{$product->name}} ({{$product->quantity}})</a>
                                <small class="text-slate-700">{{currency($product->final_price['old'])}}</small>
                            </div>
                            <div class="col-span-2 text-right">
                                <strong class="">${{currency($product->final_price['price'] * $product->quantity)}}</strong>
                                @if($product->final_price['has_discount'])
                                    <small class="line-through">${{currency($product->final_price['old'] * $product->quantity)}}</small>
                                @endif
                            </div>    
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
                   
                    <div class="flex justify-between">
                        <span>Descuento</span>
                        <strong>
                            -${{currency($discount)}}
                        </strong>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between">
                        <strong>Total</strong>
                        <strong>${{currency($subtotal-$discount)}}</strong>
                    </div>

                    <a href="#" class="bg-orange-600 text-white rounded py-3 px-5 mt-5 block text-center hover:bg-orange-900">Realizar Pedido</a>
               </div>
            
                    

            </div>
    
           
        </div>
    </div>

 



</div>





@endsection


