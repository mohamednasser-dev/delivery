@extends('admin_temp')
@php
    $route = 'restaurants';
@endphp
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('lang.restaurant_dashboard')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('restaurants.index')}}" class="text-muted">{{trans('lang.restaurants')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('home')}}" class="text-muted">{{trans('lang.home')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Education-->
    <div class="d-flex flex-row">
        <!--begin::Aside-->
        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
            <!--begin::Nav Panel Widget 2-->
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Wrapper-->
                    <div class="d-flex justify-content-between flex-column pt-4 h-100">
                        <!--begin::Container-->
                        <div class="pb-5">
                            <!--begin::Header-->
                            <div class="d-flex flex-column flex-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-120">
                                    <span class="symbol-label">
                                        <img src="{{$data->logo}}"
                                             class="h-75 align-self-end" alt=""/>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Username-->
                                <span
                                   class="card-title font-weight-bolder text-dark-75 font-size-h4 m-0 pt-7 pb-1">{{$data->name}}</span>
                                <!--end::Username-->
                                <!--begin::Info-->
                                <div class="font-weight-bold text-dark-50 font-size-sm pb-6">{{$data->type->name}}</div>
                                <!--end::Info-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="pt-1">
                                <!--begin::Text-->
                            {{--                                <p class="text-dark-75 font-weight-nirmal font-size-lg m-0 pb-7">Outlines keep you honest. If poorly thought-out metaphors driving or create keep structure</p>--}}
                            <!--end::Text-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light-danger mr-4">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z" fill="#000000" opacity="0.3"/>
        <path d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span
                                           class="text-dark-75  mb-1 font-size-lg font-weight-bolder">{{trans('lang.orders_count')}}</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">28</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-4">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                                <!--begin::Svg Icon |
                                             path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Food\Miso-soup.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M2,14 L22,14 L22,14 C22,18.9705627 17.9705627,23 13,23 L11,23 C6.02943725,23 2,18.9705627 2,14 Z" fill="#000000"/>
                                                    <path d="M16.7233675,1.41763641 C17.1846056,1.68393238 17.3426375,2.27371529 17.0763415,2.73495343 C17.070507,2.74505905 17.0644896,2.75505793 17.0582922,2.76494514 L10.5379559,13.1673758 C10.3897629,13.4038004 10.08104,13.4805452 9.83939289,13.3410302 C9.59774579,13.2015152 9.50984729,12.8957809 9.64050046,12.6492297 L15.3891015,1.80123745 C15.6384827,1.33063867 16.2221417,1.15130634 16.6927405,1.40068748 C16.7030512,1.40615136 16.7132619,1.41180193 16.7233675,1.41763641 Z M21.8768598,4.21665558 C22.2332333,4.61244851 22.2012776,5.22219993 21.8054847,5.57857348 C21.796813,5.58638154 21.7880002,5.59403156 21.7790508,5.60151976 L12.3633147,13.4799245 C12.1493155,13.6589835 11.8319871,13.6365715 11.6452796,13.4292118 C11.458572,13.221852 11.4694527,12.9039193 11.6698998,12.7098092 L20.4893582,4.16917098 C20.8719568,3.79866796 21.4824663,3.80847334 21.8529693,4.19107192 C21.8610869,4.19945456 21.8690517,4.20798385 21.8768598,4.21665558 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span
                                           class="text-dark-75 mb-1 font-size-lg font-weight-bolder">{{trans('lang.meals_count')}}</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{$data->Meals->count()}}</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light-info mr-4">
																	<span class="symbol-label">
																		<span class="svg-icon svg-icon-info svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-grid.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1"/>
        <path d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>
																	</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span
                                            class="text-dark-75  mb-1 font-size-lg font-weight-bolder">{{trans('lang.category_count')}}</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-info label-inline py-5 min-w-45px">{{$data->Categories->count()}}</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light-warning mr-2">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-warning svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Star.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#000000"/>
                                                    </g>
                                                </svg><!--end::Svg Icon-->
                                            </span>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span
                                            class="text-dark-75 mb-1 font-size-lg font-weight-bolder">{{trans('lang.rating')}}</span>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-warning label-inline py-5 min-w-45px">{{$data->rating}}</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--eng::Container-->
                        <!--begin::Footer-->

                        <!--end::Footer-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Nav Panel Widget 2-->
        </div>
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8">
            <!--begin::Card-->
            <div class="card card-custom gutter-bs">
                <!--Begin::Header-->
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x"
                            role="tablist">
                            <li class="nav-item mr-3">
                                <a href="{{route('restaurants.dashboard.show',['id'=>$data->id,'type'=>'info'])}}"
                                   class="nav-link @if($type =='info')active @endif">
                                    <span class="nav-text font-weight-bold">{{trans('lang.rest_information')}}</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a href="{{route('categories.index',['id'=>$data->id])}}"
                                   class="nav-link @if($type =='categories')active @endif">
                                    <span class="nav-text font-weight-bold">{{trans('lang.categories')}}</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a href="{{route('attributes.index',['id'=>$data->id])}}" class="nav-link @if($type =='attributes')active @endif ">

                                    <span class="nav-text font-weight-bold">{{trans('lang.attributes')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('addons.index',['id'=>$data->id])}}" class="nav-link @if($type =='addons')active @endif " >
                                    <span class="nav-text font-weight-bold">{{trans('lang.addons')}}</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a href="{{route('meals.index',['id'=>$data->id])}}" class="nav-link @if(Request()->routeIs('meals.index'))active @endif ">
                                    <span class="nav-text font-weight-bold">{{trans('lang.meals')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
{{--                                <a href="{{route('orders.index',['id'=>$data->id])}}" class="nav-link" >--}}
                                <a href="{{route('restaurant_orders.index',['id'=>$data->id])}}"  class="nav-link @if(Request()->routeIs('restaurant_orders.index'))active @endif " >

                                    <span class="nav-text font-weight-bold">{{trans('lang.orders')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('restaurant_balance.index',['id'=>$data->id])}}" class="nav-link @if(Request()->routeIs('restaurant_balance.index'))active @endif " >
                                    <span class="nav-text font-weight-bold">{{trans('lang.balance')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('restaurant_transactions.index',['id'=>$data->id])}}" class="nav-link @if(Request()->routeIs('restaurant_transactions.index'))active @endif " >
                                    <span class="nav-text font-weight-bold">{{trans('lang.transactions')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('restaurant_settings.index',['id'=>$data->id])}}" class="nav-link @if(Request()->routeIs('restaurant_settings.index'))active @endif " >
                                    <span class="nav-text font-weight-bold">{{trans('lang.settings')}}</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!--end::Header-->
                <!--Begin::Body-->
                <div class="card-body px-0">
                    <div class="tab-content pt-5">
                        <!--begin::Tab Content-->
                        <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                            @if($type == 'info')
                                @include('admin.restaurants.dashboard.info')
                            @elseif($type == 'categories')
                                @include('admin.restaurants.dashboard.categories')
                            @elseif($type == 'attributes')
                                @include('admin.restaurants.dashboard.attributes')
                            @elseif($type == 'addons')
                                @include('admin.restaurants.dashboard.addons')
                            @elseif($type == 'meals')
                                @include('admin.restaurants.dashboard.meals.meals')
                            @elseif($type == 'settings')
                                @include('admin.restaurants.dashboard.settings')
                            @elseif($type == 'balance')
                                @include('admin.restaurants.dashboard.balance')
                            @elseif($type == 'transactions')
                                @include('admin.restaurants.dashboard.transactions')
                            @elseif($type == 'orders')
                                @include('admin.restaurants.dashboard.orders')
                            @endif
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Education-->
@endsection
