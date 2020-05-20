<?php

namespace App\Http\Controllers\Admin;

use App\Models\Icon;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * 后台首页
     */
    public function index()
    {
        return view('admin.layouts.layout');
    }

    public function index1()
    {
        return view('admin.index.index');
    }

    public function index2()
    {
        return view('admin.index.index');
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     * 所有icon图标
     */
    public function icons()
    {
        $icons = Icon::orderBy('sort', 'desc')->get();
        return response()->json(['code' => 0, 'msg' => '请求成功', 'data' => $icons]);
    }

    public function menus()
    {
        $menus = \App\Models\Permission::with([
            'childs'=>function($query){$query->with('icon');}
            ,'icon'])->where('parent_id',0)->orderBy('sort','desc')->get();

        $data = [];
        foreach ($menus as $key => $menu) {
            if (Auth::user()->can($menu->name)) {
                $data[$key] = $menu->toArray();
                $data[$key]['childs'] = [];
                foreach ($menu['childs'] as $child) {
                    if (Auth::user()->can($child->name)) {
                        $data[$key]['childs'][] = $child->toArray();
                    }
                }
            }
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'data' => $data
        ];
        return response()->json($data);
    }
}
