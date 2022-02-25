<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
      'ip',
      'status'
    ];

    public static function blackListIp()
    {
        $list=[];
        foreach (self::where('status','=','black')->pluck('ip') as $key =>$item){
            array_push($list,$item);
        }
        return $list;
    }
    public static function whiteListIp()
    {
        $list=[];
        foreach (self::where('status','=','white')->pluck('ip') as $key =>$item){
            array_push($list,$item);
        }
        return $list;
    }
}
