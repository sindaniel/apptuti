@extends('layouts.seller')





@section('content')
    
    <section class="px-2 mb-5">
        <h1 class="text-secondary text-xl">Preguntas Frecuentes</h1>
    </section>
    <div class="col-span-3 block px-2" id="accordion-collapse" data-accordion="collapse" data-active-classes='text-gray-700'>
        @for ($i = 0; $i < 10; $i++)
                
            <h2 id="accordion-collapse-heading-c{{$i}}">
                <button type="button" class="bg-[#f9dfc2] bg-opacity-50 flex items-center justify-between w-full py-2 px-4 font-medium rtl:text-right   focus:ring-0 focus:ring-gray-200  gap-3 @if($i == 0) rounded-t-xl @endif @if($i == 10) rounded-b-xl @endif" data-accordion-target="#accordion-collapse-body-c{{$i}}" aria-expanded="true" aria-controls="accordion-collapse-body-c{{$i}}">
                <div class="flex items-center space-x-2">
                    <span> ¿Qué es Tuti?</span>
                </div>

                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-c{{$i}}" class="hidden bg-[#fdf5ea]" aria-labelledby="accordion-collapse-heading-c{{$i}}">
                <div class="px-3 py-3">
                   <p>Qorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan.</p>
                </div>
            </div>

        @endfor
    </div>


 

@endsection


