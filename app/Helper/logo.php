<?php

use App\Models\Logo;

if (!function_exists('logo')) {
    function logo()
    {
        $logo = Logo::where('web_id',auth()->user()->id)->first();
        if ($logo == null) {
            return '';
        }else{
            $logos = $logo->image;
            return $logos;
        }
    }
}
