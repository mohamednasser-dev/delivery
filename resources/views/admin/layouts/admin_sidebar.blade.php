<ul class="menu-nav">
    <li class="menu-item @if(request()->segment(1) == 'home') menu-item-active  @endif" aria-haspopup="true">
        <a href="{{url('/home')}}" class="menu-link">
            <i class="menu-icon flaticon-home-1"></i>
            <span class="menu-text">{{trans('s_admin.nav_home')}}</span>
        </a>
    </li>

    <li class="menu-section">
        <h4 class="menu-text">{{trans('lang.restaurants')}}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'customers' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{route('customers.index')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('lang.customers')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'restaurants' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{route('restaurants.index')}}" class="menu-link">
            <i class="menu-icon flaticon2-box"></i>
            <span class="menu-text">{{trans('lang.restaurants')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'delivery_men' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="#" class="menu-link">
            <i class="menu-icon fas fa-motorcycle"></i>
            <span class="menu-text">{{trans('lang.delivery_men')}}</span>
        </a>
    </li>
    {{--    basic_info--}}
    <li class="menu-section">
        <h4 class="menu-text">{{trans('lang.basic_info')}}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'owner_types' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/owner_types')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('lang.owner_types')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'restaurant_types' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/restaurant_types')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('lang.restaurant_types')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'nationalities' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{route('nationalities.index')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('lang.nationalities')}}</span>
        </a>
    </li>

    <li class="menu-section">
        <h4 class="menu-text">{{trans('s_admin.view_users')}}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'users' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/users')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('s_admin.view_users')}}</span>
        </a>
    </li>
    <li class="menu-item  @if( request()->segment(1) == 'roles' ) menu-item-active @endif"
        aria-haspopup="true">
        {{--                                href="{{url('/roles')}}"--}}
        <a href="{{url('/roles')}}" class="menu-link">
            <i class="menu-icon flaticon-interface-1"></i>
            <span class="menu-text">{{trans('s_admin.nav_permissions')}}</span>
        </a>
    </li>

    <li class="menu-section">
        <h4 class="menu-text">{{trans('lang.settings')}}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    <li class="menu-item menu-item-submenu @if( Request::segment(1)== 'pages' ) menu-item-open @endif"
        aria-haspopup="true" data-menu-toggle="hover">
        <a href="{{route('pages')}}" class="menu-link menu-toggle">
            <i class="menu-icon flaticon2-paper"></i>
            <span class="menu-text">صفحات التطبيق</span>
        </a>
    </li>
    <li class="menu-item menu-item-submenu @if( Request::segment(1)== 'screens' ) menu-item-open @endif"
        aria-haspopup="true" data-menu-toggle="hover">
        <a href="{{route('screens')}}" class="menu-link menu-toggle">
            <i class="menu-icon flaticon2-browser"></i>
            <span class="menu-text">الشاشات الترحيبية</span>
        </a>
    </li>
    <li class="menu-item menu-item-submenu @if( Request::segment(1)== 'links' ) menu-item-open @endif"
        aria-haspopup="true" data-menu-toggle="hover">
        <a href="{{route('links')}}" class="menu-link menu-toggle">
            <i class="menu-icon flaticon-tool-1"></i>
            <span class="menu-text">الروابط</span>
        </a>
    </li>
    <li class="menu-item @if(request()->segment(1) == 'settings') menu-item-active  @endif" aria-haspopup="true">
        <a href="{{route('settings')}}" class="menu-link">
            <i class="menu-icon flaticon2-settings"></i>
            <span class="menu-text">{{trans('lang.settings')}}</span>
        </a>
    </li>
</ul>
