<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        'name', 'age', 'sex',
    ];

    public function getSexAttribute($value)
    {
        $options = ['保密', '男', '女'];
        return $options[$value];
    }
}
