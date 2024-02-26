@extends('layouts.seller')

@section('content')
   
    @include('seller.elements.navigation')

    <section class="">
        <ul class="space-y-2 p-2 divide-y">
            @for ($i = 0; $i < 2; $i++)
                <li class=" grid gap-x-5 grid-cols-8 items-center pr-4">
                    <div class="col-span-2">
                        <img src="{{asset('img/product1.jpeg')}}" class="w-[400px]" >
                    </div>
                    <div class="py-2 col-span-6 space-y-2 relative">
                        <h3 class="font-bold">
                            <a href="{{route('sellers.product')}}">
                                Encendedor texas rodeo colores surtidos
                            </a>
                        </h3>
                        <div class="flex justify-between">
                            
                            <div class=" flex items-center justify-center ">
                                <button class="text-white bg-blue1 rounded-full w-5 h-5  flex items-center justify-center">-</button>
                                <input type="text" class="w-10 h-5 text-center bg-transparent border-0  px-4 text-primary" disabled value="1">
                                <button class="text-white bg-blue1 rounded-full w-5 h-5  flex items-center justify-center">+</button>
                            </div>
                            <div>
                                 <span>Precio: $ 1.378</span>
                            </div>
                        </div>
                    </div>
                </li>
            @endfor 

           
        </ul>
    </section>
    <section class="p-5">
        <div>
            <div class="flex justify-between">
                <span>Subtotal</span>
                <strong>$200.000</strong>
            </div>
            
            <div class="flex justify-between">
                <span>Descuento</span>
                <strong>-$20.000</strong>
            </div>
          
            <div class="flex justify-between">
                <span>Total</span>
                <strong>$180.000</strong>
            </div>

              <hr class="my-2">

            <h3 class="capitalize font-bold mb-2 text-xl mt-5">Información de entrega</h3>
            <div>
                <div class="flex space-x-4">
                    <span>Información:</span>
                    <strong>Nombre</strong>
                </div>
                
                <div class="flex space-x-4">
                    <span>Información:</span>
                    <strong>Identificación</strong>
                </div>
                <div class="flex space-x-4">
                    <span>Información:</span>
                    <strong>Dirección de entrega</strong>
                </div>

            </div>

            <h3 class="capitalize font-bold mb-2 text-xl mt-2">Observaciones</h3>

            <textarea name="" id="" class="w-full h-48 border-0 bg-gray-200" ></textarea>


            <div class="flex items-center ">
                <input type="checkbox" name="" id="terms" class="mr-2 border-secondary">
                <label for="terms" class="cursor-pointer">Acepto los términos y condiciones</label>
            </div>


            <button class="bg-secondary text-white rounded py-3 px-5 mt-5 block text-center hover:bg-orange-900 w-full">Realizar Pedido</button>


        </div>
    </section>


   


  
@endsection