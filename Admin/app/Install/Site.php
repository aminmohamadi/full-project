<?php

namespace App\Install;

use Models\Option;
use Models\Setting;

class Site
{
    public function setup($data)
    {
        Option::setMany([
            'site_name' => $data['name'],
            'site_email' => $data['email'],
            'site_phone' => $data['phone'],
            'site_front'=>$data['front']
        ]);
    }
}
