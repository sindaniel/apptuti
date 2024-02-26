@extends('layouts.shopper')





@section('content')
    
    <section class="px-2">
        <h1 class="text-secondary text-xl">Pedido #1</h1>
    </section>
    <section class="">
        <ul class="space-y-2 p-2 divide-y">
            @for ($i = 0; $i < 5; $i++)
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
                        <div class="flex justify-between items-end">
                            
                            <div class="leading-5 text-sm">
                                Cantidad: 00  <br>
                                Descuento: 7%
                            </div>
                            <div>
                                 <strong> $ 1.378</strong>
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
                <strong>Total</strong>
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

            <p>Morem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.</p>



            <button class="bg-secondary text-white rounded py-3 px-5 mt-5 block text-center hover:bg-orange-900 w-full">Pedir de nuevo</button>


        </div>
    </section>


 

@endsection


