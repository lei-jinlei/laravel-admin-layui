<?php

return [
    'operation_log' => [
        'except' => [],
        'method' => [
            'GET'
        ]
    ],

    'permissions' => [
        [
            'name' => 'system.manage',
            'display_name' => '系统管理',
            'route' => '',
            'icon_id' => '100',
            'child' => [
                [
                    'name' => 'system.user',
                    'display_name' => '用户管理',
                    'route' => 'admin.user',
                    'icon_id' => '123',
                    'child' => [
                        ['name' => 'system.user.create', 'display_name' => '添加用户', 'route' => 'admin.user.create'],
                        ['name' => 'system.user.edit', 'display_name' => '编辑用户', 'route' => 'admin.user.edit'],
                        ['name' => 'system.user.destroy', 'display_name' => '删除用户', 'route' => 'admin.user.destroy'],
                        ['name' => 'system.user.role', 'display_name' => '分配角色', 'route' => 'admin.user.role'],
                        ['name' => 'system.user.permission', 'display_name' => '分配权限', 'route' => 'admin.user.permission'],
                    ]
                ],
                [
                    'name' => 'system.role',
                    'display_name' => '角色管理',
                    'route' => 'admin.role',
                    'icon_id' => '121',
                    'child' => [
                        ['name' => 'system.role.create', 'display_name' => '添加角色', 'route' => 'admin.role.create'],
                        ['name' => 'system.role.edit', 'display_name' => '编辑角色', 'route' => 'admin.role.edit'],
                        ['name' => 'system.role.destroy', 'display_name' => '删除角色', 'route' => 'admin.role.destroy'],
                        ['name' => 'system.role.permission', 'display_name' => '分配权限', 'route' => 'admin.role.permission'],
                    ]
                ],
                [
                    'name' => 'system.permission',
                    'display_name' => '权限管理',
                    'route' => 'admin.permission',
                    'icon_id' => '12',
                    'child' => [
                        ['name' => 'system.permission.create', 'display_name' => '添加权限', 'route' => 'admin.permission.create'],
                        ['name' => 'system.permission.edit', 'display_name' => '编辑权限', 'route' => 'admin.permission.edit'],
                        ['name' => 'system.permission.destroy', 'display_name' => '删除权限', 'route' => 'admin.permission.destroy'],
                    ]
                ],
                [
                    'name' => 'system.log',
                    'display_name' => '系统日志',
                    'route' => 'admin.systemLog',
                    'icon_id' => '12',
                ],
                [
                    'name' => 'system.operationLog',
                    'display_name' => '操作日志',
                    'route' => 'admin.operationLog',
                    'icon_id' => '12',
                ],
                [
                    'name' => 'system.redisManager',
                    'display_name' => 'Redis管理',
                    'route' => 'admin.redisManager',
                    'icon_id' => '12',
                ]
            ]
        ],
    ],
];