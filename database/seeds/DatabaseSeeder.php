<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        用户,权限基础表初始化(重置权限)
        $this->call(UserTableSeeder::class);

//        icon数据初始化
        $this->call(IconTableSeeder::class);

//        后续只需要权限列表初始化
//        $this->call(PermissionTableSeeder::class);

    }
}
