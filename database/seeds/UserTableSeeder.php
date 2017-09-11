<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'    => 'admin@qq.com',
            'password' => Hash::make('123456'),
            'nickname' => 'admin',
            'is_admin' => 1,
        ]);
    }
}
