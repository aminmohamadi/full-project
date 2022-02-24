<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $this->seo()
            ->setTitle('صفحه اصلی')
            ->setDescription('شرکت برهان ایمن ، اراِه دهنده محصولات ایمنی ساحتمان ها')

        ;
        return view('welcome');
    }
}
