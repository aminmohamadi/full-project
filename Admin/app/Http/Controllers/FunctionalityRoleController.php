<?php

namespace App\Http\Controllers;

use Models\Functionality;
use Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FunctionalityRoleController extends Controller
{
    public function showAction(Role $role)
    {
        $items = [];
        $allFunctions = Functionality::all();
        foreach ($allFunctions as $index => $function) {
            if ($role->functionalities()->where('functionality_id','=',$function->id)->count() === 1){
                $function_is_set = true;
            } else {
                $function_is_set = false;
            }
            $items[$index] = ['id' => $function->id, 'name' => $function->name, 'checked' => $function_is_set];
        }

        $pageName="Role-Functionalities";
        return view('functionality-role.index',compact('pageName','items'));
    }
    public function storeAction(Request $request, Role $role)
    {
        $role->functionalities()->sync($request->functionality);
        Alert::toast('عملکردها با موفقیت افزوده شدند', 'success');
        return back();
    }
}
