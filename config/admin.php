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
            'name' => 'admin.system',
            'display_name' => '系统管理',
            'route' => '',
            'icon_id' => '100',
            'child' => [
                [
                    'name' => 'admin.system.user.index',
                    'display_name' => '用户管理',
                    'route' => 'admin.system.user.index',
                    'icon_id' => '123',
                    'child' => [
                        ['name' => 'admin.system.user.create', 'display_name' => '添加用户', 'route' => 'admin.system.user.create'],
                        ['name' => 'admin.system.user.edit', 'display_name' => '编辑用户', 'route' => 'admin.system.user.edit'],
                        ['name' => 'admin.system.user.destroy', 'display_name' => '删除用户', 'route' => 'admin.system.user.destroy'],
                        ['name' => 'admin.system.user.role', 'display_name' => '分配角色', 'route' => 'admin.system.user.role'],
                        ['name' => 'admin.system.user.permission', 'display_name' => '分配权限', 'route' => 'admin.system.user.permission'],
                    ]
                ],
                [
                    'name' => 'admin.system.role.index',
                    'display_name' => '角色管理',
                    'route' => 'admin.system.role.index',
                    'icon_id' => '121',
                    'child' => [
                        ['name' => 'admin.system.role.create', 'display_name' => '添加角色', 'route' => 'admin.system.role.create'],
                        ['name' => 'admin.system.role.edit', 'display_name' => '编辑角色', 'route' => 'admin.system.role.edit'],
                        ['name' => 'admin.system.role.destroy', 'display_name' => '删除角色', 'route' => 'admin.system.role.destroy'],
                        ['name' => 'admin.system.role.permission', 'display_name' => '分配权限', 'route' => 'admin.system.role.permission'],
                    ]
                ],
                [
                    'name' => 'admin.system.permission.index',
                    'display_name' => '权限管理',
                    'route' => 'admin.system.permission.index',
                    'icon_id' => '12',
                    'child' => [
                        ['name' => 'admin.system.permission.create', 'display_name' => '添加权限', 'route' => 'admin.system.permission.create'],
                        ['name' => 'admin.system.permission.edit', 'display_name' => '编辑权限', 'route' => 'admin.system.permission.edit'],
                        ['name' => 'admin.system.permission.destroy', 'display_name' => '删除权限', 'route' => 'admin.system.permission.destroy'],
                    ]
                ],
                [
                    'name' => 'admin.system.systemLog.index',
                    'display_name' => '系统日志',
                    'route' => 'admin.system.systemLog.index',
                    'icon_id' => '12',
                ],
                [
                    'name' => 'admin.system.operationLog.index',
                    'display_name' => '操作日志',
                    'route' => 'admin.system.operationLog.index',
                    'icon_id' => '12',
                ],
                [
                    'name' => 'admin.system.redisManager',
                    'display_name' => 'Redis管理',
                    'route' => 'admin.system.redisManager',
                    'icon_id' => '12',
                ]
            ]
        ],
    ],
];