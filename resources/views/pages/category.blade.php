@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>$category->name, 
        'description'=> $category->sort_description
        ])
@endsection



@section('content')
    

<div class="w-full">
    <h1 class="text-3xl mb-5">{{ $category->name }}</h1>
</div>
<div class="grid grid-cols-4 gap-4">
    @foreach ($products as $product)

        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                
                <a href="{{route('product', $product->slug)}}" class="text-gray-900  hover:text-blue-500">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $product->name }}</h5>
                </a>
                {{-- <p class="mb-5 font-normal text-gray-700 dark:text-gray-400">
                    {!! $product->short_description !!}
                </p> --}}


                <p class="mb-5  text-gray-700 text-2xl ">
                    <x-price :product='$product'  />
                </p>
            
            </div>
        </div>
        
    @endforeach
</div>


{{ $products->withQueryString()->links() }}

@endsection