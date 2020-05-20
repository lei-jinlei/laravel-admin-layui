<?php
/**
 * Created by PhpStorm.
 * User: 00JOY
 * Date: 2019/5/28
 * Time: 15:59
 */

namespace App\Http\Controllers\Admin\System;


use App\Models\OperationLog;
use App\Models\User;
use Illuminate\Http\Request;

class OperationLogController extends Controller
{
    public function index()
    {
        return view('admin.system.operationLog.index')->with([
            'methods' => OperationLog::$METHODS,
            'users' => User::all()->pluck('name', 'id')
        ]);
    }

    public function data(Request $request)
    {
        $query = OperationLog::dealWhere($request);
        $res = $query->with('user')->paginate($request->get('limit', 30))->toArray();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }
}