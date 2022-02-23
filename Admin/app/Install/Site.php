<?php

namespace App\Install;

use Models\Setting;

class Site
{
    public function setup($data)
    {
        Setting::setMany([
            'site_name' => $data['name'],
            'site_email' => $data['email'],
            'site_phone' => $data['phone'],
            'site_front'=>$data['front']
        ]);
    }
}
