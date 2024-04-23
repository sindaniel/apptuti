@props(['product'])
<div class="border border-gray-100 rounded">
    <div class="flex w-full items-center justify-center py-2 text-gray-400">
        @if($product->images->first())
            <a href="{{route('product', $product->slug)}}"  class="h-40 block w-full bg-cover bg-center" style="background-image: url({{asset('storage/'.$product->images->first()->path)}});">
            </a>
        @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
        </svg>
        @endif

        
    </div>
    <div class="flex px-2 py-2 justify-between">
        <a href="{{route('product', $product->slug)}}" class="bg-blue1 rounded-full w-6 h-6 block p-1 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </a>
        <a href="{{route('product', $product->slug)}}" class="bg-gray3 hover:bg-gray2 flex px-4 text-sm rounded-full items-center justify-center">
            <span>Ver</span>
        </a>
    </div>
    
    <div class="bg-gray3 p-2 space-y-2 flex flex-col">
        <div>
            <strong class="text-sm">$ {{currency($product->final_price['price'])}}</strong>
            @if($product->final_price['has_discount'])
                <small class="line-through">${{currency($product->final_price['old'])}}</small>
            @endif
        </div>
        <a href="{{route('product', $product->slug)}}" class="text-xs text-[#180F09]">{{$product->name}}</a>
        @if($product->categories->first())
        <p class="text-xs text-[#180F09]">{{$product->categories->first()->name}}</p>
        @endif
    </div>
</div>