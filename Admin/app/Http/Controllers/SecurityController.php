<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Security;

class SecurityController extends Controller
{
    public function blacklistAction(){

        $items = Security::where('status','=','black')->get();
        return view('security.blacklist.index',compact('items'));
    }

    public function blockAction()
    {

    }

    public function whitelistAction()
    {
        $items = Security::where('status','=','white')->get();
        return view('security.whitelist.index',compact('items'));
    }
    public function whiteAction()
    {

    }
}
