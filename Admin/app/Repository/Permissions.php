<?php


namespace App\Repository;


class Permissions
{
    public static function getAllAvailablePermissions()
    {
        return static::allAvailablePermissions();
    }
    protected static function allAvailablePermissions()
    {
        $controllers = [];
        $controllerAddress = glob(app_path('Http\Controllers') . "\*Controller.php");
        foreach ($controllerAddress as $controller) {
            $classes = substr(basename($controller), 0, strlen(basename($controller)) - 4);
            $strToLowerClassName = strtolower($classes);
            $controllerName=substr($strToLowerClassName,0,-10);
            $controllers[$controllerName] = [];
            $reflectionClass = new \ReflectionClass('App\Http\Controllers\\' . $classes);
            $methods = array_filter($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC),function ($method) use ($reflectionClass) {
                return  $method->class == $reflectionClass->getName();
            });
            foreach ($methods as $method) {
                if (substr($method->name, -6, 6) == 'Action') {
                    $controllers[$controllerName][] = $controllerName.'.'.str_replace('Action', '', $method->name);
                }
            }
        }
        return $controllers;
    }
}
