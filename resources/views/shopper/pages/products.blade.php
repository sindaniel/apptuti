@extends('layouts.shopper')

@section('content')
    @include('shopper.elements.navigation')
    


    <section class='p-3'>
        <div class="bg-secondary rounded p-3 text-white">
            <form action="" class="grid grid-cols-2 gap-4" >
                <div class="flex flex-col">
                    <label for="">Línea</label>
                    {{Aire::select(['Manganeso'], 'category_id')->groupClass('mb-0')}}
                </div>
                <div class="flex flex-col">
                    <label for="">Grupo</label>
                    {{Aire::select(['Manganeso'], 'category_id')->groupClass('mb-0')}}
                </div>
                
            </form>
        </div>

    </section>


    <section>
        <ul class="space-y-2 p-2">
            @for ($i = 0; $i < 5; $i++)
                <li class="bg-white border shadow rounded grid gap-x-5 grid-cols-8 items-center pr-4">
                    <div class="col-span-2 bg-blue2 h-full text-white items-center justify-center flex">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                        </svg>
                    </div>
                <div class="py-2 col-span-6  ">
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