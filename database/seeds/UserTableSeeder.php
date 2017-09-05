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
            'email'    => 'admin@shiyanlou.com',
            'password' => Hash::make(''),
            'nickname' => 'admin',
            'is_admin' => 1,
        ]);
    }
}
