@extends('layouts.page')


@section('head')
    @include('elements.seo', [
        'title'=>$brand->name, 
        'description'=> $brand->sort_description
        ])
@endsection



@section('content')
    

<div class="w-full">
    <h1 class="text-3xl mb-5">{{ $brand->name }}</h1>
</div>
<div class="grid grid-cols-5 gap-4">
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
                    @if ($product->discount)
                        <div class="flex flex-col">
                            <span>
                               <strong> ${{ number_format($product->price * (1 - $product->discount/100),2) }}</strong>
                                <small class="text-gray-500">({{ $product->discount }}%)</small>
                            </span>
                            <small class="line-through">${{ number_format($product->price,2) }}</small>
                        </div>
                        
                        @else
                        <div class="flex flex-col">
                            <span>
                               <strong> ${{ number_format($product->price * (1 - $product->discount/100),2) }}</strong>
                            </span>
                           
                        </div>
                    @endif
                </p>
            
            </div>
        </div>
        
    @endforeach
</div>


{{ $products->withQueryString()->links() }}

@endsection