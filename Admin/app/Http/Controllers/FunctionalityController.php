<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Permissions;
use Models\Functionality;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FunctionalityController extends Controller
{

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
}
