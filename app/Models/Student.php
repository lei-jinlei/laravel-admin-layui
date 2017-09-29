<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // 指定表名
    protected $table = 'students';

    // 指定id
    protected $primaryKey = 'id';

    // 自动维护时间戳
    protected $timestamps = true;

    // 设置维护时间变成手机戳
    // protected function getDateFormat()
    // {
    //     return time();
    // }

    // 展示时间戳时候自定义
    // protected function asDateTime($val)
    // {
    //     return $val;
    // }
    
    // 指定不允许赋值的字段
    protected $guarded = [];


    // 指定允许批量赋值的字段
    protected $fillable = [
        'name', 'age', 'sex',
    ];
    

    public function getSexAttribute($value)
    {
        $options = ['保密', '男', '女'];
        return $options[$value];
    }
}
