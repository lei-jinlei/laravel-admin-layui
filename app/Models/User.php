<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use function foo\func;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 头像
    public function gravatar($size = '100')
    {
        $hash = md5(strtotime(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    // 微博
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    // 微博列表
    public function feed()
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    // 粉丝
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // 关注
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    // 关注用户
    public function follow($user_ids)
    {
        if (!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    // 取消关注
    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)){
            $user_ids = compact($user_ids);
        }
        $this->followings()->delete($user_ids);
    }

    // 是否关注
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
