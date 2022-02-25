<?php


namespace App\Install;


use App\Repository\Permissions;

class Functionality
{
    public static function setup()
    {
        $functionality = Permissions::getAllAvailablePermissions();
        foreach ($functionality as $item) {
            $count = \Models\Functionality::where('name', $item)->count();
            if (!$count > 0) {
                Functionality::create([
                    'name'=>$item
                ]);
            }
        }
    }
}
