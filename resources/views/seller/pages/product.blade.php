@extends('layouts.seller')



@section('head')

   <link rel="stylesheet" href="{{asset('assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owl.theme.default.min.css')}}">

@endsection



@section('content')
    
    <section class="px-5">
            <div class="owl-carousel text-gray-400">
                <div class="h-60 w-full bg-[#eae9e7] rounded flex items-center justify-center">
                    <img src="{{asset('img/product1.jpeg')}}" alt="">
                </div>
                <div class="h-60 w-full bg-[#eae9e7] rounded flex items-center justify-center">
                    <img src="{{asset('img/product2.png')}}" alt="">
                </div> 
            </div>

            <ul class="grid grid-cols-4 gap-4">
                <li class="border">
                    <img src="{{asset('img/product1.jpeg')}}" alt="">
                </li>
                <li class="border">
                    <img src="{{asset('img/product1.jpeg')}}" alt="">
                </li>
            </ul>

            <article class="my-5 space-y-4">
                <h3 class="text-secondary text-xl font-bold"> 
                    Encendedor texas rodeo colores surtidos
                </h3>
                <p>
                   <span class="line-through text-gray-400"> $1.450</span> <strong>- $1.378</strong>
                </p>
                <p>
                    Encendedor Swiss Lite Grande al por Mayor.
                </p>
                <ul class="list-disc pl-5">
                    <li>conforme con el estándar iso 9994</li>
                    <li>encendido electrónico</li>
                    <li>alta hermeticidad</li>
                    <li>encendido rápido</li>
                    <li>llama ajustable</li>
                    <li>apagado seguro</li>
                    <li>llama estable</li>
                    <li>diseño anatómico</li>
                </ul>

                <div>
                    <h4 class="font-bold mb-2">Presentación</h4>
                    <ul class="flex space-x-2">
                        <li class="border px-2 py-2 font-bold">12und</li>
                        <li class="border px-2 py-2 font-bold">12und</li>
                        <li class="border px-2 py-2 font-bold">12und</li>
                    </ul>
                </div>
            </article>


           
            
    </section>

     <footer class="shadow px-5 py-4 border-t flex justify-between items-center">
            <div class=" flex items-center justify-center pb-1">
                <button class="text-white bg-blue1 rounded-full w-8 h-8  flex items-center justify-center">-</button>
                <input type="text" class="w-10 h-5 text-center bg-transparent text-xl font-bold border-0  px-4 text-primary" disabled value="1">
                <button class="text-white bg-blue1 rounded-full w-8 h-8  flex items-center justify-center">+</button>
            </div>
            <form action="">
                <button class="bg-secondary text-white px-10 py-2 rounded text-xl ">Agregar</button>
            </form>
        </footer>

@endsection



@section('scripts')
    <script src="{{asset('assets/owl.carousel.min.js')}}"></script>
    
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            items: 1,

        })
    </script>

@endsection