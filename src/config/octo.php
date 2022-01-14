<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CDN LINK
    |--------------------------------------------------------------------------
    | By default SweetAlert2 use its local sweetalert.all.js
    | file.
    | However, you can use its cdn if you want.
    |
    */

    'shop_id' => env('OCTO_SHOP_ID'),

    'octo_secret' => env('OCTO_SECRET_KEY'),

    'octo_lang' => env('OCTO_LANG', 'en'),

];
