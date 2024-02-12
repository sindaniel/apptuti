@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>'Carrito de compras', 
        'description'=> 'Carrito de compras'
        ])
@endsection



@section('content')
    



<div class="grid grid-cols-12 w-full gap-y-5 gap-x-5">

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
                                <span>Añadir dirección</span>
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
                    @for ($i = 0; $i < 5; $i++)
                       <div class="grid grid-cols-12 items-center gap-x-2">
                            <a href="" class="col-span-2">
                                <img src="{{asset('img/product1.jpeg')}}" alt="">
                            </a>
                            <span class="col-span-8 px-3">
                                Bombillo LED 7W Santablanca 10.000H
                            </span>
                            <strong>$40.000</strong>
                       </div>
                    @endfor
           
                </div>

               <div class="text-sm">
                 <hr class="my-4">

           
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <strong>$200.000</strong>
                    </div>
                   
                    <div class="flex justify-between">
                        <span>Descuento</span>
                        <strong>-$20.000</strong>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between">
                        <span>Total</span>
                        <strong>$180.000</strong>
                    </div>

                    <a href="#" class="bg-orange-600 text-white rounded py-3 px-5 mt-5 block text-center hover:bg-orange-900">Realizar Pedido</a>
               </div>
            
                    

            </div>
    
           
        </div>
    </div>

 



</div>





@endsection


