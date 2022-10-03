
<!DOCTYPE html>

        @if(session('lang')=='en')
            <html lang="en">
            <!--begin::Head-->
            <head><base href="">
            <meta charset="utf-8" />
            <title>Medical laravel</title>
            <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="canonical" href="https://keenthemes.com/metronic" />
            <!--begin::Fonts-->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
            <!--end::Fonts-->
            <!--begin::Page Vendors Styles(used by this page)-->
            <link href="{{ asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Page Vendors Styles-->
            <!--begin::Global Theme Styles(used by all pages)-->
            <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Global Theme Styles-->
            <!--begin::Layout Themes(used by all pages)-->
            <link href="{{ asset('metronic/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Layout Themes-->
            <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logos/favicon.ico') }}" />
                <link rel="preconnect" href="https://fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
                <style>
                body {
                    font-family: 'Noto Sans JP', sans-serif !important;
                    font-size: 48px;
                }
            </style>
            @yield('styles')
        @else
            <html direction="rtl" dir="rtl" style="direction: rtl" >
            <!--begin::Head-->
            <head><base href="">
            <meta charset="utf-8" />
            <title>Medical laravel</title>
            <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="canonical" href="https://keenthemes.com/metronic" />
            <!--begin::Fonts-->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
            <!--end::Fonts-->
            <!--begin::Page Vendors Styles(used by this page)-->
            <link href="{{ asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Page Vendors Styles-->
            <!--begin::Global Theme Styles(used by all pages)-->
            <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Global Theme Styles-->
            <!--begin::Layout Themes(used by all pages)-->
            <link href="{{ asset('metronic/assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Layout Themes-->
            <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logos/favicon.ico') }}" />
            @yield('styles')
        @endif
            <style>
                /* Chrome, Safari, Edge, Opera */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                /* Firefox */
                input[type=number] {
                    -moz-appearance: textfield;
                }
            </style>
                @if (empty(session('coloradmin')))
                    @if (isset($_GET['coloradmin']))
                        @php
                            session(['coloradmin' => $_GET['coloradmin']]);
                        @endphp
                        <style>
                            .header-mobile, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link, .header-fixed.subheader-fixed .header, .brand, .aside, .aside-menu , .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-link {
                                background-color: {{ session('coloradmin')}};
                            }
                        </style>
                    @endif
                @else
                    @if (isset($_GET['coloradmin']))
                        @php
                            session(['coloradmin' => $_GET['coloradmin']]);
                        @endphp
                        <style>
                            .header-mobile, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link, .header-fixed.subheader-fixed .header, .brand, .aside, .aside-menu , .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-link {
                                background-color: {{ session('coloradmin')}};
                            }
                        </style>
                    @else
                        <style>
                            .header-mobile, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link, .header-fixed.subheader-fixed .header, .brand, .aside, .aside-menu , .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-heading, .aside-menu .menu-nav>.menu-item.menu-item-open>.menu-link {
                                background-color: {{ session('coloradmin')}};
                            }
                        </style>
                    @endif
                @endif
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <!--begin::Header Mobile-->
