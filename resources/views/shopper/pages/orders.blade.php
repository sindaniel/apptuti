@extends('layouts.shopper')





@section('content')
    
    <section class="px-2">
        <h1 class="text-secondary text-xl">Mis Pedidos</h1>
        <ul class="my-5 space-y-4">
            @for ($i = 0; $i < 2; $i++)
                <li class="bg-info bg-opacity-20 rounded p-4  space-y-5">
                    <div class="grid grid-cols-2">
                        <div>
                            <strong>Nº 0012340123</strong>
                            <p class="text-sm leading-4">
                                EL PUNTO DE LA 97 <br>
                                Gloria Patricia Acevedo <br>
                                Fecha
                            </p>
                        </div>
                        <div class="">
                            <p class="flex flex-col text-end  leading-4">
                                <strong>$ 250.000</strong>
                                <small class="text-gray-400">Enviada</small>
                            </p> 
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                        <a href='{{route('shoppers.order', 1)}}' class="bg-blue-500 text-white w-full py-2 rounded-full px-10">Detalles </a>
                        </div>
                        <a href="#" class="text-blue-500">Cancelar Pedido</a>
                    </div>
                </li>
            @endfor
        </ul>


        <a href="#" class="bg-offert w-full py-3 block text-center rounded font-bold">Sincronizar Pedidos</a>
    </section>

 

@endsection


