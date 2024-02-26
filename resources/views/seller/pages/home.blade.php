@extends('layouts.seller')

@section('content')
     @include('seller.elements.navigation')
    @include('seller.elements.categories')
    


    <section class="bg-info bg-opacity-10">
        <ul class="space-y-2 p-2">
            @for ($i = 0; $i < 5; $i++)
                <li class="bg-white rounded grid gap-x-5 grid-cols-8 items-center pr-4">
                    <div class="col-span-2">
                        <img src="{{asset('img/product1.jpeg')}}" class="w-[400px]" >
                    </div>
                    <div class="py-2 col-span-6 space-y-2 ">
                        <h3 class="text-secondary text-xl font-bold">
                            <a href="{{route('sellers.product')}}">
                                Encendedor texas rodeo colores surtidos
                            </a>
                        </h3>
                        <div class="flex justify-between items-end">
                            <div class="flex flex-col">
                                <span>Precio: $ 1.378</span>
                                <span>Info: 0000</span>
                                <span>Info: 3333</span>
                            </div>
                            <div class=" flex items-center justify-center pb-1">
                                <button class="text-white bg-blue1 rounded-full w-5 h-5  flex items-center justify-center">-</button>
                                <input type="text" class="w-10 h-5 text-center bg-transparent border-0  px-4 text-primary" disabled value="1">
                                <button class="text-white bg-blue1 rounded-full w-5 h-5  flex items-center justify-center">+</button>
                            </div>

                        </div>
                    </div>
                </li>
            @endfor 

           
        </ul>
    </section>
@endsection