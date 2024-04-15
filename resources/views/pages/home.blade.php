@extends('layouts.page')


@section('head')

    @include('elements.seo', [
        'title'=>'Home', 
        'description'=>'Description del home'
        ])

        <link rel="stylesheet" href="{{asset('assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/owl.theme.default.min.css')}}">
@endsection


@section('content')
    
<section class="w-full">
    <div class="owl-carousel text-gray-400">
        @foreach ($banners as $banner)
            <div class="xl:h-96 h-40 w-full bg-[#eae9e7] rounded flex items-center justify-center">
                <img src="{{asset('storage/'.$banner->path)}}" class="w-full">
            </div>
        @endforeach
    </div>
</section>


<section class="w-full grid grid-cols-12 gap-x-10 xl:gap-y-0 gap-y-10">
    <div class="col-span-3 hidden xl:block" id="accordion-collapse" data-accordion="collapse" data-active-classes='text-gray-700'>
        
        @foreach ($categories as $category)

            <h2 id="accordion-collapse-heading-c{{$category->id}}">
                 {{-- @if($i == 0) rounded-t-xl @endif @if($i == 10) rounded-b-xl @endif --}}
                <button type="button" class="bg-blue2 flex items-center justify-between w-full py-2 px-4 font-medium rtl:text-right text-gray-500  focus:ring-0 focus:ring-gray-200  gap-3" data-accordion-target="#accordion-collapse-body-c{{$category->id}}" aria-expanded="true" aria-controls="accordion-collapse-body-c{{$category->id}}">
                <div class="flex items-center space-x-2">
                    <span class="icon-energy"></span>
                    <span>{{$category->name}}</span>
                </div>

                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-c{{$category->id}}" class="hidden bg-blue3" aria-labelledby="accordion-collapse-heading-c{{$category->id}}">
                <div class="px-3 py-3">
                    <ul class="pl-7 text-sm space-y-2">
                        <li><a class="text-gray-600" href="{{route('category', $category->slug)}}">{{$category->name}}</a></li>
                        @foreach ($category->children as $subcategory)
                            <li><a class="text-gray-600" href="{{route('category2', $subcategory->slug)}}">{{$subcategory->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
        @endforeach

      
      
    </div>
    <div class="xl:col-span-6 col-span-12 ">
        <div class="grid grid-cols-2 xl:grid-cols-3 gap-5 ">
            @foreach ($products as $product)
                <x-product :product="$product"/>
            @endforeach
           
        </div>
    </div>

    <div class="xl:col-span-3 col-span-12">
        <div class=" ">
            <h2 class="bg-offert border border-offert rounded-t text-center py-2">
                Oferta de la semana
            </h2>
            <div class="border rounded-b border-offert">
                <div class="flex items-center justify-center text-gray-400 py-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <div class="border-t py-4  px-4 space-y-3">
                    <div class="flex justify-center items-center space-x-2">
                         <strong class="text-xl">$12.000</strong>
                         <span class="line-through text-xs">$11.000</span>
                    </div>
                    <p class="text-sm  text-center">Bombillo LED 7W Santablanca 10.000H</p>
                      <p class="text-xs  text-center">Presentación</p>
                </div>
            </div>
           
        </div>
    </div>
</section>





{{-- <div class="container mx-auto" >
    <div class="w-full md:block md:w-auto py-10" id="navbar-multi-level">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white  md: ">
        <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:  md:" aria-current="page">Home</a>
        </li>
        <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 hover:bg-gray-50 md:hover:bg-transparent  md:hover:text-blue-700 md:p-0 md:w-auto ">Productos <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="z-10 font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44   hidden">
                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownLargeButton">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category', $category->slug) }}" class="block px-4 py-2 hover:bg-gray-100">{{ $category->name }}</a>
                        </li>
                        
                    @endforeach
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100  ">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100  ">Dashboard</a>
                    </li>
                    <li aria-labelledby="dropdownNavbarLink">
                    <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100  ">Dropdown<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                    <div id="doubleDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(10px, 0px, 0px);" data-popper-placement="right-start" data-popper-reference-hidden="" data-popper-escaped="">
                        <ul class="py-2 text-sm text-gray-700 " aria-labelledby="doubleDropdownButton">
                            <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100   ">Overview</a>
                            </li>
                            <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100   ">My downloads</a>
                            </li>
                            <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100   ">Billing</a>
                            </li>
                            <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100   ">Rewards</a>
                            </li>
                        </ul>
                    </div>
                    </li>
                    <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100  ">Earnings</a>
                    </li>
                </ul>
                <div class="py-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Sign out</a>
                </div>
            </div>
        </li>
        <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0  md:   md:">Services</a>
        </li>
        <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0  md:   md:">Pricing</a>
        </li>
        <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0  md:   md:">Contact</a>
        </li>
        </ul>
    </div>
</div> --}}


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