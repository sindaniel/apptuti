@extends('layouts.shopper')

@section('content')
    @include('shopper.elements.navigation')
    


    <section class='p-3'>
        <div class="bg-secondary rounded p-3 text-white">
            <form action="" class="grid grid-cols-2 gap-4" >
                <div class="flex flex-col">
                    <label for="">Ruta</label>
                    {{Aire::select([1,2,4,5], 'category_id')->groupClass('mb-0')}}
                </div>
                <div class="flex flex-col">
                    <label for="">Día</label>
                    {{Aire::select([1,2,4,5], 'category_id')->groupClass('mb-0')}}
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>

                    </div>
                <div class="py-2 col-span-6  ">
                        <h3 class="text-secondary text-xl font-bold">
                            <a href="{{route('sellers.product')}}">
                                El punto de la 97
                            </a>
                        </h3>
                        <div class="flex justify-between items-end">
                            <div class="flex flex-col">
                                <span>Gloria Patricia Gómez Alzate</span>
                                <span>Dirección: CL 97 74A 24</span>
                                <span>Celular: 3007743845</span>
                                <span>Correo: gloria@tronex.com</span>
                            </div>
                        </div>
                    </div>
                </li>
            @endfor 

           
        </ul>
    </section>
    



@endsection