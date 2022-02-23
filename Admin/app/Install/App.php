<?php

namespace App\Install;

use Models\Role;
use Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Modules\Currency\Entities\CurrencyRate;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class App
{
    public function setup()
    {
//        $this->generateAppKey();
        $this->setEnvVariables();
        $this->createStorageFolder();
    }

//    private function generateAppKey()
//    {
//        Artisan::call('key:generate', ['--force' => true]);
//    }

    private function setEnvVariables()
    {
        $env = DotenvEditor::load();

        $env->setKey('APP_ENV', 'production');
        $env->setKey('APP_DEBUG', 'false');
        $env->setKey('APP_CACHE', 'true');
        $env->setKey('APP_URL', url('/'));

        $env->save();
    }


    private function createStorageFolder()
    {
        if (! is_dir(public_path('storage'))) {
            mkdir(public_path('storage'));
        }
    }
}
