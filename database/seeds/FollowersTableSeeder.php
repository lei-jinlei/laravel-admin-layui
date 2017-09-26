<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // 获取去除掉 ID 为 1 的所有用户ID数组
        $followers = $users->slice(1);
        $followers_ids = $followers->pluck('id')->toArray();

        // 关注除了1号用户以外的所有用户
        $user->follow($followers_ids);

        // 除了1号用户以外的所有用户都来关注1号用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
