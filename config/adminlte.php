<?php

use App\Models\User;

$role_usuario = new User();
$role = $role_usuario->adminlte_desc();
return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'JatunCode',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Jatun</b>CODE',
    'logo_img' => 'vendor/adminlte/dist/img/jatuncode.ico',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/jatuncode.ico',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/jatuncode.ico',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */
    
    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:


    //    ['header' => 'Inicio'],
       [
           'text' => 'Inicio',
           'route'  => 'docente.inicio',
           'icon' => 'fa fa-home',
           'can'  => 'docente',
        ],
        
        [
            'header' => 'Solicitudes',
            'can'    => 'docente',
        ],
        [
            'text'       => 'Registrar una solicitud',
            'icon'       => 'fa fa-book',
            'icon_color' => 'green',
            'route'      => 'docente.solicitud.normal',
            'can'    => 'docente',
        ],
        [
            'text'       => 'Visualizar mis solicitudes',
            'icon'       => 'fas fa-list',
            'icon_color' => 'green',
            'route'      => 'docente.solicitud.listar',
            'can'    => 'docente',
        
        ],
        [
            'text'       => 'Cancelar Solicitud',
            'icon'       => 'fas fa-solid fa-ban',
            'icon_color' => 'red',
            'route'      => 'docente.solicitud.cancelar',
            'can'    => 'docente',
        
        ],
        [
            'header' => 'Reservas',
            'can'    => 'docente',
        ],
        [
            'text'       => 'Visualizar mis reservas',
            'icon'       => 'fa fa-book',
            'icon_color' => 'green',
            'route'      => 'docente.reservas.listar',
            'can'    => 'docente',
        ],
        // [
        //     'text'       => 'Cancelar reserva',
        //     'icon'       => 'fas fa-solid fa-ban',
        //     'icon_color' => 'red',
        //     'route'      => 'docente.solicitud.filtrar.datos',
        //     'can'    => 'docente',
        
        // ],
        [
            'header' => 'Mapa',
            'can'    => 'docente',
        ],
        [
            'text'       => 'Mapa facultativo',
            'icon'       => 'bi bi-map',
            'icon_color' => 'green',
            'route'      => 'mapa.index',
            'can'    => 'docente',
        ],
        
        //!!Rutas de Admin
        [
            'text' => 'Inicio',
            'route'  => 'admin.inicio',
            'icon' => 'fa fa-home',
            'can'  => 'admin',
        ],
        [
            'header' => ' Solicitudes' ,
            'can'    => 'admin',
        ],
        [
            'text'       => 'Registrar solicitud',
            'icon'       => 'bi bi-journal-plus',
            'icon_color' => 'green',
            'route'      => 'admin.solicitud.registrar',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Atender solicitud',
            'icon'       => 'bi bi-journal-bookmark-fill',
            'icon_color' => 'green',
            'route'      => 'admin.reservas.atender',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Visualizar solicitudes',
            'icon'       => 'bi bi-journal-text',
            'icon_color' => 'yellow',
            'route'      => 'admin.listar.solicitudes',
            'can'    => 'admin',
        ],
        [
            'header' => 'Ambientes' ,
            'can'    => 'admin',
        ],
        [
            'text'       => 'Registrar ambiente',
            'icon'       => 'bi bi-building-fill-add',
            'icon_color' => 'green',
            'route'      => 'admin.ambiente.registrar',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Visualizar ambientes',
            'icon'       => 'bi bi-buildings',
            'icon_color' => 'yellow',
            'route'      => 'admin.ambientes.list',
            'can'    => 'admin',
        ],
        [
            'header' => 'Horarios' ,
            'can'    => 'admin',
        ],
        [
            'text'       => 'Registrar horario',
            'icon'       => 'bi bi-table',
            'icon_color' => 'green',
            'route'      => 'admin.horario.registrar',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Modificar horarios',
            'icon'       => 'fa fa-book',
            'icon_color' => 'green',
            'route'      => 'admin.horarios.modificar',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Visualizar horarios',
            'icon'       => 'bi bi-table',
            'icon_color' => 'yellow',
            'route'      => 'admin.horarios.list',
            'can'    => 'admin',
        ],
        [
            'header' => 'Reservas',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Cancelar reserva',
            'icon'       => 'bi bi-journal-x',
            'icon_color' => 'red',
            'route'      => 'admin.reservas.cancelar',
            'can'    => 'admin',
        ],
        // [
        //     'text'       => 'Visualizar reservas',
        //     'icon'       => 'bi bi-journal-text',
        //     'icon_color' => 'yellow',
        //     'route'      => 'admin.layouts.reservas',
        //     'can'    => 'admin',
        // ],
        [
            'header' => 'Reportes',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Ambientes',
            'icon'       => 'fa fa-chart-line',
            'icon_color' => 'yellow',
            'route'      => 'admin.reportes',
            'can'    => 'admin',
        ],
        [
            'header' => 'Mapa',
            'can'    => 'admin',
        ],
        [
            'text'       => 'Mapa facultativo',
            'icon'       => 'bi bi-map',
            'icon_color' => 'green',
            'route'      => 'admin.mapa.facultad',
            'can'    => 'admin',
        ],
        [
            'header' => 'Mensajes y notificaciones',
            'can'    => 'admin',
        ],
        [
            'text'       => 'MailBox',
            'icon'       => 'bi bi-inboxes',
            'icon_color' => 'yellow',
            'route'      => 'admin.notificaciones.list',
            'can'    => 'admin',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor\datatables\js\jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor\datatables\js\dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor\datatables\css\dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor\sweetalert2\sweetalert2.all.min.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
