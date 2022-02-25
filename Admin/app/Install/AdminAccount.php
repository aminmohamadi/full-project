<?php

namespace App\Install;

use App\Repository\Permissions;
use Models\Role;
use Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class AdminAccount
{
    public function setup($data)
    {
        $role = Role::create(['name' => 'Admin', 'slug' => 'admin', 'description' => 'مدیر کل']);
        $admin = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'national_code' => $data['national_code'],
            'gender' => $data['gender'],
            'status' => true,
            'password' => bcrypt($data['password']),
            'role_id'=>$role->id
        ]);
        $role->functionalities()->sync(\Models\Functionality::all()->pluck('name'));

    }

}
