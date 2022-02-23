<?php

namespace App\Http\Controllers;

use Models\Role;
use Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repository\Menu as MenuItems;

class MenuController extends Controller
{

    public function showAction(Role $role)
    {
        $pageName = 'RoleMenu';
        return view('menu.index', compact('pageName', 'role'));
    }

    public function createAction(Role $role)
    {
        $panelTitle = 'ایجاد منو نقش';
        $action = route('role.menu.store',$role->id);
        $items = MenuItems::get_availabel_menu_items();
        $menu = new Menu();
        return view('menu.form', compact('items', 'panelTitle','action','menu'));
    }

    public function storeAction(Role $role, Request $request)
    {
        $role->menu()->create([
            'name' => $request->name,
            'page_name' => $request->page_name,
            'route_name' => $request->route_name,
            'icon' => $request->icon,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
        ]);
        Alert::toast('نقش با موفقیت ذخیره شد', 'success');
        $pageName = 'role menu';
        $items = $role->menu;
        return redirect()->route('role.menu.show', $role->id);

    }

    public function editAction(Menu $menu)
    {
        $panelTitle = 'ویرایش منو نقش';
        $action = route('role.menu.update',$menu->id);
        $items = MenuItems::get_availabel_menu_items();
        $method="PATCH";
        return view('menu.form', compact('items', 'panelTitle','menu','action','method'));
    }

    public function updateAction(Menu $menu,Request $request){
        $menu->update([
            'title' => $request->title,
            'pageName' => $request->pageName,
            'route_name' => $request->route_name,
            'icon' => $request->icon,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
        ]);
        Alert::toast('منو با موفقیت به روزرسانی شد', 'success');
        $pageName = 'RoleMenu';
        $items = $menu->role->menu;
        return redirect()->to("/menu/{$menu->role->id}")->with(['pageName', 'items']);
    }

    public function destroyAction(Menu $menu)
    {
        $menu->delete();
        Alert::toast('منو با موفقیت حذف شد', 'success');
        $pageName = 'RoleMenu';
        $items = $menu->role->menu;
        return redirect()->to("/menu/{$menu->role->id}")->with(['pageName', 'items']);

    }
}
