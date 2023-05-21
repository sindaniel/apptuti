<?php
if (! function_exists('asset_url')) {
    function asset_url($image, $size=null)
    {   
        
        $asset_url =  config('app.asset_url');

        if($size == null){
            return "{$asset_url}/{$image}.jpg";
        }

        return "{$asset_url}/{$image}-{$size}x{$size}.jpg";
            

        
    }
}


if (! function_exists('public_asset')) {
    function public_asset($file)
    {   
        $path = config('app.url');
        return "{$path}/{$file}";
        
    }
}



if (! function_exists('price')) {
    function price($price, $discount= 0)
    {   
      
        if($discount){
            $price = $price * (1 - $discount/100);
        }
        $price = number_format($price, 0, ',', '.');

        return "$ ".$price;
        
    }
}
