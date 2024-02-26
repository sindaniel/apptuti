@extends('layouts.shopper')

@section('content')
   
    @include('shopper.elements.navigation')

    <section class="">
        <ul class="space-y-2 p-2 divide-y">
            @for ($i = 0; $i < 2; $i++)
                <li class=" grid gap-x-5 grid-cols-8 items-center pr-4">
                    <div class="col-span-2 bg-blue2 h-full text-white items-center justify-center flex">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                        </svg>
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


           


            <button class="bg-secondary text-white rounded py-3 px-5 mt-5 block text-center hover:bg-orange-900 w-full">Realizar Pedido</button>


        </div>
    </section>


   


  
@endsection