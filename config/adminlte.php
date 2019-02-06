<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'AdminLTE 3',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo
    | is address of your logo png file, logo_text is your logo text.
    |
    */

    'logo' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

    'logo_text' => '<b>Admin</b>LTE 3',


    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Pages',
            'url'         => 'admin/pages',
            'icon'        => 'file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url'  => 'admin/settings',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url'  => 'admin/settings',
            'icon' => 'lock',
        ],
        [
            'text'    => 'Multilevel',
            'icon'    => 'share',
            'submenu' => [
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
                [
                    'text'    => 'Level One',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Level Two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'Level Two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'Level Three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url'  => '#',
                ],
            ],
        ],
        'LABELS',
        [
            'text'       => 'Important',
            'icon_color' => 'red',
        ],
        [
            'text'       => 'Warning',
            'icon_color' => 'yellow',
        ],
        [
            'text'       => 'Information',
            'icon_color' => 'aqua',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        acharsoft\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        acharsoft\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        acharsoft\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        acharsoft\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        acharsoft\LaravelAdminLte\Menu\Filters\GateFilter::class,
        acharsoft\LaravelAdminLte\Menu\Filters\MenuPermission::class,
        acharsoft\LaravelAdminLte\Menu\Filters\LangFilter::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included.
    | Set the value to address of your plugins
    | to include the JavaScript file from your plugins a script tag.
    |
    */

    'plugins_js' => [
        'bootstrap-slider' => 'vendor/adminlte/plugins/bootstrap-slider/bootstrap-slider.js',
        'bootstrap-wysihtml5'    => 'vendor/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'chartjs-old'    => 'vendor/adminlte/plugins/chartjs-old/Chart.min.js',
        'ckeditor'    => 'vendor/adminlte/plugins/ckeditor/ckeditor.js',
        'colorpicker'    => 'vendor/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js',
        'datepicker'    => 'vendor/adminlte/plugins/datepicker/bootstrap-datepicker.js',
        'fastclick'    => 'vendor/adminlte/plugins/fastclick/fastclick.min.js',
        'iCheck'    => 'vendor/adminlte/plugins/iCheck/icheck.min.js',
        'ionslider'    => 'vendor/adminlte/plugins/ionslider/ion.rangeSlider.min.js',
        'jQueryUI'    => 'vendor/adminlte/plugins/jQueryUI/jquery-ui.min.js',
        'knob'    => 'vendor/adminlte/plugins/knob/jquery.knob.js',
        'morris'    => 'vendor/adminlte/plugins/morris/morris.min.js',
        'pace'    => 'vendor/adminlte/plugins/pace/pace.min.js',
        'slimScroll'    => 'vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
        'sparkline'    => 'vendor/adminlte/plugins/sparkline/jquery.sparkline.min.js',
        'timepicker'    => 'vendor/adminlte/plugins/timepicker/bootstrap-timepicker.min.js',
        'bootstrap'    => 'vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'raphael'    => 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'jvectormap'    => 'vendor/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which CSS plugins should be included.
    | Set the value to address of your plugins
    | to include the CSS file from your plugins a link style tag.
    |
    */

    'plugins_css' => [
        'bootstrap-slider' => 'vendor/adminlte/plugins/bootstrap-slider/slider.css',
        'bootstrap-wysihtml5'    => 'vendor/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'colorpicker'    => 'vendor/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css',
        'datepicker'    => 'vendor/adminlte/plugins/datepicker/datepicker3.css',
        'iCheck'    => 'vendor/adminlte/plugins/iCheck/all.css',
        'ionslider'    => 'vendor/adminlte/plugins/ionslider/ion.rangeSlider.css',
        'morris'    => 'vendor/adminlte/plugins/morris/morris.css',
        'pace'    => 'vendor/adminlte/plugins/pace/pace.min.css',
        'timepicker'    => 'vendor/adminlte/plugins/timepicker/bootstrap-timepicker.min.css',
        'font-awesome'    => 'vendor/adminlte/plugins/font-awesome/css/font-awesome.min.css',
        'ionicons'    => 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'adminlte_rtl'    => 'vendor/adminlte/dist/css/adminlte.min.css',
        'adminlte_ltr'    => 'vendor/adminlte/ltr/dist/css/adminlte.min.css',
        'iCheck_blue'    => 'vendor/adminlte/plugins/iCheck/flat/blue.css',
        'jvectormap'    => 'vendor/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'daterangepicker'    => 'vendor/adminlte/plugins/daterangepicker/daterangepicker-bs3.css',
    ],
];

