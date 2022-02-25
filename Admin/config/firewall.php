<?php

use Models\Security;

return [

    /*
    |--------------------------------------------------------------------------
    | Whitelist IPS
    |--------------------------------------------------------------------------
    |
    | This is an array of IPs that are whitelisted in your application.
    | eg:   - 127.0.0.1
    |       - 127.0.0.*
    |       - 127.0.0.1/200
    */

//    'whitelist' => Security::whiteListIp(),
//    'blacklist'=> Security::blackListIp(),
    'whitelist' => [
        '127.0.0.1'
    ],

];
