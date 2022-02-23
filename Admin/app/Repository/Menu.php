<?php


namespace App\Repository;


class Menu
{
    public static function get_availabel_menu_items()
    {
        return static::availabel_menu_items();
    }
    protected static function availabel_menu_items()
    {
        $routes = collect(\Route::getRoutes())->map(function ($route) { return $route->getName(); });
        $indexRoutes = [];
        foreach ($routes as $item){
            if (substr($item, -5, 5) == 'index')  {
                $indexRoutes[]=$item;
            }
        };
        return $indexRoutes;
    }
}
