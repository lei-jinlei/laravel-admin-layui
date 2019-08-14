<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空表
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('permissions')->truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //admin用户
        $user = \App\Models\User::where('username', 'admin')->first();

        //超级管理员角色
        $role = \App\Models\Role::where('name', 'root')->first();

        //权限(不可减少权限列表)
        $permissions = config('admin.permissions');

        foreach ($permissions as $pem1) {
            //生成一级权限
            $p1 = \App\Models\Permission::create([
                'name' => $pem1['name'],
                'display_name' => $pem1['display_name'],
                'route' => $pem1['route']??'',
                'icon_id' => $pem1['icon_id']??1,
            ]);
            //为角色添加权限
            if (!$role->hasPermissionTo($p1)) {
                $role->givePermissionTo($p1);
            }

            //为用户添加权限
            if (!$user->hasPermissionTo($p1)) {
                $user->givePermissionTo($p1);
            }

            if (isset($pem1['child'])) {
                foreach ($pem1['child'] as $pem2) {
                    //生成二级权限
                    $p2 = \App\Models\Permission::create([
                        'name' => $pem2['name'],
                        'display_name' => $pem2['display_name'],
                        'parent_id' => $p1->id,
                        'route' => $pem2['route']??1,
                        'icon_id' => $pem2['icon_id']??1,
                    ]);
                    //为角色添加权限
                    if (!$role->hasPermissionTo($p2)) {
                        $role->givePermissionTo($p2);
                    }

                    //为用户添加权限
                    if (!$user->hasPermissionTo($p2)) {
                        $user->givePermissionTo($p2);
                    }
                    if (isset($pem2['child'])) {
                        foreach ($pem2['child'] as $pem3) {
                            //生成三级权限
                            $p3 = \App\Models\Permission::create([
                                'name' => $pem3['name'],
                                'display_name' => $pem3['display_name'],
                                'parent_id' => $p2->id,
                                'route' => $pem3['route']??'',
                                'icon_id' => $pem3['icon_id']??1,
                            ]);
                            //为角色添加权限
                            if (!$role->hasPermissionTo($p3)) {
                                $role->givePermissionTo($p3);
                            }

                            //为用户添加权限
                            if (!$user->hasPermissionTo($p3)) {
                                $user->givePermissionTo($p3);
                            }
                        }
                    }

                }
            }
        }


    }
}
