@extends('layouts.page')

@section('head')
    @include('elements.seo', [
        'title'=>$product->name, 
        'description'=> $product->sort_description
        ])
@endsection

@section('content')
    

<h1 class="text-4xl font-bold">{{ $product->name }}</h1>
<div class="w-full">
    <p>
        {!! $product->short_description !!}
    </p>


    <div class="mt-5">
        @foreach ($product->labels as $label)
            
            <a href="{{ route('label', $label->slug) }}" class="inline-block bg-blue-500 hover:bg-blue-700 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2">{{ $label->name }}</a>

        @endforeach
    </div>
</div>






@if($product->related->count() )
<hr class="borde-b border-blue-500 my-10 w-full">
<div class="w-full">
    <h2 class="font-bold text-xl mb-5">Productos relacionados</h2>
</div>
<div class="grid grid-cols-4 gap-4">
    @foreach ($product->related as $product)

        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
                
                <a href="{{route('product', $product->slug)}}" class="text-gray-900  hover:text-blue-500">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $product->name }}</h5>
                </a>
              


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

@endif


@endsection