<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // 与comments表关联
    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'article_id', 'id');
    }

    /**
     * 存入数据库的时候；把数组转成 json
     * @param  string  $value
     * @return void
     */
    // public function setTagIdAttribute($value)
    // {
    //     $this->attributes['tag_id'] = json_encode($value);
    // }

    /**
     * 获取数据时把json转成php数组
     *
     * @param  string  $value
     * @return string
     */
    // public function getTagIdAttribute($value)
    // {
    //     return json_decode($value, true);
    // }



}
