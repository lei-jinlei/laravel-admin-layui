<?php

namespace App\Models;


class Icon extends Base
{
    protected $table = 'icons';
    protected $fillable = ['unicode','class','name','sort'];

    //对应菜单
    public function menus()
    {
        return $this->hasMany('App\Models\Menu','icon_id','id');
    }
}
