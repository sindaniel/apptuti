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

if (! function_exists('asset_name')) {
    function asset_name($folder)
    {   
        $random = Str::random(40);
        return "{$folder}/{$random}";
        
    }
}