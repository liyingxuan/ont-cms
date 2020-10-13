<?php

return [

    /*
     * Laravel-admin name.
     */
    'name'      => 'ONT CMS',

    /*
     * Logo in admin panel header.
     */
    'logo'      => '<b>ONT</b> CMS',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>CMS</b>',

    /*
     * Route configration.
     */
    'route' => [

        'prefix' => 'admin',

        'namespace'     => 'App\\Admin\\Controllers',

        'middleware'    => ['web', 'admin'],
    ],

    /*
     * Laravel-admin install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * Laravel-admin html title.
     */
    'title'  => 'ONT CMS',

    /*
     * Use `https`.
     */
    'secure' => true,

    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | 后台是否使用https
    |
    */
    'https' => env('ADMIN_HTTPS', true),

    /*
     * Laravel-admin auth setting.
     */
    'auth' => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Encore\Admin\Auth\Database\Administrator::class,
            ],
        ],
    ],

    /*
     * Laravel-admin upload setting.
     */
    'upload'  => [
        // `config/filesystem.php`中设置的disk
        'disk' => 'admin',

        // image和file类型表单元素的上传目录
        'directory'  => [
            'image'  => 'images',
            'file'   => 'files',
        ],
    ],

    /*
     * Laravel-admin database setting.
     */
    'database' => [

        // Database connection for following tables.
        'connection'  => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Encore\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table'  => 'admin_menu',
        'menu_model'  => Encore\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
     * By setting this option to open or close operation log in laravel-admin.
     */
    'operation_log'   => [

        'enable' => true,

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Skin
    |--------------------------------------------------------------------------
    |
    | 皮肤设置，参考https://adminlte.io/docs/2.4/layout设置
    |
    | 支持的设置为:
    |    "skin-blue", "skin-blue-light", "skin-yellow", "skin-yellow-light",
    |    "skin-green", "skin-green-light", "skin-purple", "skin-purple-light",
    |    "skin-red", "skin-red-light", "skin-black", "skin-black-light".
    |
    */
    'skin' => 'skin-blue-light',

    /*
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
     */
    'layout'  => ['sidebar-mini', 'sidebar-collapse'],

    /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | 登录页面的背景图设置
    |
    */
    'login_background_image' => '',

    /*
        |--------------------------------------------------------------------------
        | Show version at footer
        |--------------------------------------------------------------------------
        |
        | 是否在页面的右下角显示当前laravel-admin的版本
        |
        */
    'show_version' => false,
    'version'   => 'Ontology-CMS-v1.18.12',

    /*
    |--------------------------------------------------------------------------
    | Show environment at footer
    |--------------------------------------------------------------------------
    |
    | 是否在页面的右下角显示当前的环境
    |
    */
    'show_environment' => true,

    /*
     * Settings for extensions.
     */
    'extensions' => [

    ],
];
