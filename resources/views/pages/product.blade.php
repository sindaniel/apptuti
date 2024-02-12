@extends('layouts.page')

@section('head')
    {{-- @include('elements.seo', [
        'title'=>$product->name, 
        'description'=> $product->sort_description
        ]) --}}
@endsection

@section('content')
    


<div class="grid grid-cols-12 w-full gap-y-5 gap-x-5">

    <div class="col-span-12">
        <ul class="flex  space-x-2 text-gray-500">
            <li><a href="">Home</a></li>
            <li><a href="">Productos</a></li>
            <li><a href="">Iluminación</a></li>
        </ul>
    </div>

    <div class="xl:col-span-6 col-span-12">
        <div class="grid grid-cols-12 gap-5">
            <div class="xl:col-span-3 col-span-12 xl:order-1 order-2">
                <ul class="grid xl:grid-cols-1 grid-cols-4 gap-2">
                    <li class="border p-2">
                        <a href="">
                            <img src="{{asset('img/product1.jpeg')}}" alt="">
                        </a>
                    </li>
                    <li class="border p-2">
                        <a href="">
                            <img src="{{asset('img/product2.png')}}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="xl:col-span-9 col-span-12 xl:order-2 order-1">
                <div class="border p-2">
                    <img src="{{asset('img/product1.jpeg')}}" alt="">
                </div>
                
            </div>
        </div>
    </div>  

    <div class="xl:col-span-6 col-span-12 space-y-4">
        <h1 class="text-2xl">Bombillo LED 7W Santablanca 10.000H</h1>

        <div class="flex justify-start items-center space-x-2">
            <strong class="text-xl">$12.000</strong>
            <span class="line-through text-xs">$11.000</span>
        </div>

        <p>
            Vorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.Vorem ipsum dolor sit 
        </p>

        <ul class="list-disc pl-5">
            <li>Bombillo led A60 7W</li>
            <li>Multivoltaje</li>
            <li>10.000 horas de duración</li>
            <li>Luz Fría</li>
        </ul>

        <div class="flex flex-col space-y-2">
            <strong>Presentación</strong>
            <ul class="flex  space-x-2 font-bold">
                <li class="border rounded px-2 py-1">12und</li>
                <li class="border rounded px-2 py-1">12und</li>
                <li class="border rounded px-2 py-1">12und</li>
            </ul>
        </div>

        <div class="bg-blue3 flex items-center justify-center">
            <button class="text-blue1 text-5xl">-</button>
            <input type="text" class="w-20 text-center bg-transparent border-0 text-xl px-4" disabled value="1">
            <button class="text-blue1 text-5xl">+</button>
        </div>

        <div>
            <button class="bg-secondary w-full flex items-end justify-center text-xl space-x-2 py-2 rounded hover:bg-opacity-90 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <span>
                    Añadir al Carrito
                </span>
                
            </button>
        </div>

        

    </div>

   <div class="xl:col-span-6 col-span-12 py-5">
        <h3 class="font-bold text-xl mb-2">Detalles del producto</h3>
        <p>
            Horem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna. 
        </p>
    </div>


    <div class="col-span-12 py-5">
        <h3 class="font-bold text-xl mb-2">Productos Relacionados</h3>
        <div class="grid grid-cols-2 xl:grid-cols-6 gap-5 ">
           
            @for ($i = 0; $i < 6; $i++)
                <div class="border border-gray-100 rounded">
                    <div class="flex w-full items-center justify-center py-5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="flex px-2 py-2 justify-between">
                        <a href="" class="bg-blue1 rounded-full w-6 h-6 block p-1 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>
                        <a href="{{route('product', 'leonard-chaney')}}" class="bg-gray3 hover:bg-gray2 flex px-4 text-sm rounded-full items-center justify-center">
                            <span>Ver</span>
                        </a>
                    </div>
                    <div class="bg-gray3 p-2 space-y-2">
                        <strong class="text-sm">$ 12.000</strong>
                        <p class="text-xs text-[#180F09]">Bombillo LED 7W Santablanca 10.000H</p>
                        <p class="text-xs text-[#180F09]">Presentación</p>
                    </div>
                </div>
            @endfor
        
        </div>
    </div>




</div>

@endsection


@section('scripts')
     
    <script>
        $(function(){
            
            const discount =  '{{$product->finalPrice['discount']}}'
           
            $('#selectPrice').on('change', function(){
             
                let price = $(this).find(':selected').data('price')
                
                if(discount){
                    $('#oldprice').html(currency(parseInt(price)))
                    price = price - (price * (discount/100))
                }
                console.log(currency(price));
                $('#price').html(currency(price))
            })
        })

    </script>


@endsection