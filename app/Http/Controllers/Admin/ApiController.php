<?php
/**
 * Created by PhpStorm.
 * User: 00JOY
 * Date: 2019/5/30
 * Time: 18:41
 */

namespace App\Http\Controllers\Admin;


use App\Common\Components\Consts;
use App\Models\coeus\GameServer;
use App\Models\coeus\GameService;
use App\Models\coeus\GameVersion;
use App\Models\oceanus\Channel;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function init()
    {
        $data = [
            "clearInfo" => [
                "clearUrl" => "api/clear.json",
            ],
            'homeInfo' => [
                "title" => "首页",
                "icon" => "layui-icon-home",
                "href" => route("admin.index1")
            ],
            'logoInfo' => [
                "title" => "Admin",
                "image" => "/images/logo.png",
                "href" => ""
            ],
        ];

        $menus = \App\Models\Permission::with([
            'childs' => function ($query) {
                $query->with('icon');
            }
            , 'icon'])->where('parent_id', 0)->orderBy('sort', 'desc')->get();

        foreach ($menus as $menu) {
            if (Auth::user()->can($menu->name)) {
                $tmp_name = implode('_', explode('.', $menu->name));
                $data['menuInfo'][$tmp_name] = ["title" => $menu->display_name, "icon" => $menu->icon->class];
                foreach ($menu->childs as $key => $child) {
                    if (Auth::user()->can($child->name)) {
                        $tmp = [
                            "title" => $child->display_name,
                            "href" => $child->route ? route($child->route) : '',
                            "icon" => $child->icon->class,
                            "target" => $child->route ? '_self' : '',
                        ];
                        if (!$child->route) {
                            $grandsons = Permission::where('parent_id', $child->id)->with('icon')->get();
                            $tmp['child'] = [];
                            foreach ($grandsons as $grandson) {
                                if (Auth::user()->can($grandson->name)) {
                                    $tmp['child'][] = [
                                        "title" => $grandson->display_name,
                                        "href" => $grandson->route ? route($grandson->route) : '',
                                        "icon" => $grandson->icon->class,
                                        "target" => $grandson->route ? '_self' : '',
                                    ];
                                }
                            }
                        }
                        $data['menuInfo'][$tmp_name]['child'][] = $tmp;
                    }
                }
            }
        }

        return response()->json($data);
    }
}