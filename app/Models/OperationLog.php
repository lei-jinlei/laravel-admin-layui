<?php
/**
 * Created by PhpStorm.
 * User: 00JOY
 * Date: 2019/5/28
 * Time: 15:23
 */

namespace App\Models;


use Illuminate\Http\Request;

class OperationLog extends Base
{
    protected $fillable = ['user_id', 'path', 'method', 'ip', 'input'];

    public static $METHODS = [
        'GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH',
        'LINK', 'UNLINK', 'COPY', 'HEAD', 'PURGE',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public static function dealWhere(Request $request)
    {
        $query = new OperationLog();

        $wheres = [
            'id', 'user_id', 'method', 'path', 'ip'
        ];
        foreach ($wheres as $value) {
            if (isset($request->$value)) {
                $query = $query->where($value, $request->$value);
            }
        }

        if (isset($request->field) && isset($request->order)) {
            $query = $query->orderBy($request->field, $request->order);
        } else {
            $query = $query->orderBy('id', 'desc');
        }

        return $query;
    }

}