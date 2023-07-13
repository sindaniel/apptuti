@props(['product', 'single'=>false])

<div>
    @if(!$single) @endif
    <strong id='price'>${{ currency($product->finalPrice['price'])}}</strong>   
    
    @if($product->finalPrice['discount'])
        <span class='line-through' id='oldprice'>${{  currency($product->finalPrice['old'] ) }}</span>
        <small id='discount' data-discount='{{ $product->finalPrice['discount'] }}'>{{ $product->finalPrice['discount'] }}%</small>
    @endif
</div>