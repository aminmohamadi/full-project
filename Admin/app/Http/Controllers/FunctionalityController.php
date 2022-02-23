<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Permissions;
use Models\Functionality;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FunctionalityController extends Controller
{
    public $indexAction="show-functionalities";
    public $storeAction="store-functionalities";
    public function indexAction()
    {
        $allFunctionalities = Permissions::getAllAvailablePermissions();
        $items=[];
        foreach ($allFunctionalities as $key => $value){
            $items[$key]=[];
            foreach ($value as $function) {
               $functionality=Functionality::where('name',$function)->count();
                if ($functionality > 0){
                    $function_is_set = true;
                }else{
                    $function_is_set = false;
                }
                $items[$key][]=['gate'=>$function,'checked'=>$function_is_set];
            }
        }
        $pageName = 'functionalities';

        return view('functionalities.index', compact('items', 'pageName'));
    }
    public function storeAction(Request $request)
    {
        try {
            foreach ($request->functionality as $item) {
                $count = Functionality::where('name', $item)->count();
                if (!$count > 0) {
                    Functionality::create([
                        'name'=>$item
                    ]);
                }
            }
            Alert::toast("عملیات با موفقیت انجام شد", 'success');
            return redirect()->route('functionality.index');

        } catch (\Exception $exception) {
            return response()->json(['status' => 'danger', 'message' => 'خطا در انجام عملیات', 'title' => 'خطا', 'icon' => 'check_box']);

        }
    }
    protected function allFunctionalities()
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
//                    $controllers[$controllerName][str_replace('Action', '', $method->name)] = [];
                    $controllers[$controllerName][] = $controllerName.'.'.str_replace('Action', '', $method->name);
                }
            }
        }
        return $controllers;

    }
}
