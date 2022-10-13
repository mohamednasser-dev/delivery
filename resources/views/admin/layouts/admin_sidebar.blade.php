<ul class="menu-nav">
    <li class="menu-item @if(request()->segment(1) == 'home') menu-item-active  @endif" aria-haspopup="true">
        <a href="{{url('/home')}}" class="menu-link">
            <i class="menu-icon flaticon-home-1"></i>
            <span class="menu-text">{{trans('s_admin.nav_home')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'restaurant_types' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/restaurant_types')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('lang.restaurant_types')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'owner_types' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/owner_types')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('lang.owner_types')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'restaurants' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/restaurants')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('s_admin.restaurants')}}</span>
        </a>
    </li>
    <li class="menu-item @if( request()->segment(1) == 'delivery_men' ) menu-item-active @endif "
        aria-haspopup="true">
        <a href="{{url('/delivery_men')}}" class="menu-link">
            <i class="menu-icon flaticon2-user"></i>
            <span class="menu-text">{{trans('s_admin.delivery_men')}}</span>
        </a>
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
</ul>
