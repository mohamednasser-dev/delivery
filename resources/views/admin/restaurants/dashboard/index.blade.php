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
                                <a href="javascript:;"
                                   class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">{{$data->name}}</a>
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
                                    <div class="symbol symbol-45 symbol-light mr-4">
																	<span class="symbol-label">
																		<span
                                                                            class="svg-icon svg-icon-2x svg-icon-dark-50">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<rect fill="#000000" opacity="0.3"
                                                                                          x="13" y="4" width="3"
                                                                                          height="16" rx="1.5"/>
																					<rect fill="#000000" x="8" y="9"
                                                                                          width="3" height="11"
                                                                                          rx="1.5"/>
																					<rect fill="#000000" x="18" y="11"
                                                                                          width="3" height="9"
                                                                                          rx="1.5"/>
																					<rect fill="#000000" x="3" y="13"
                                                                                          width="3" height="7"
                                                                                          rx="1.5"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="javascript:;"
                                           class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{trans('lang.orders_count')}}</a>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">28</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-4">
																	<span class="symbol-label">
																		<span
                                                                            class="svg-icon svg-icon-2x svg-icon-dark-50">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<rect fill="#000000" x="4" y="4"
                                                                                          width="7" height="7"
                                                                                          rx="1.5"/>
																					<path
                                                                                        d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                                                        fill="#000000" opacity="0.3"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="javascript:;"
                                           class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{trans('lang.meals_count')}}</a>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">{{$data->Meals->count()}}</span>
                                    <!--end::label-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center pb-9">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-45 symbol-light mr-4">
																	<span class="symbol-label">
																		<span
                                                                            class="svg-icon svg-icon-2x svg-icon-dark-50">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<path
                                                                                        d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                                                        fill="#000000"
                                                                                        fill-rule="nonzero"/>
																					<circle fill="#000000" opacity="0.3"
                                                                                            cx="12" cy="10" r="6"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <a href="javascript:;"
                                           class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{trans('lang.category_count')}}</a>
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::label-->
                                    <span
                                        class="font-weight-bolder label label-xl label-light-info label-inline py-5 min-w-45px">{{$data->Categories->count()}}</span>
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
                                <a href="{{route('restaurants.dashboard.show',['id'=>$data->id,'type'=>'categories'])}}"
                                   class="nav-link @if($type =='categories')active @endif">
                                    <span class="nav-text font-weight-bold">{{trans('lang.categories')}}</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a href="{{route('restaurants.dashboard.show',['id'=>$data->id,'type'=>'attributes'])}}" class="nav-link @if($type =='attributes')active @endif ">

                                    <span class="nav-text font-weight-bold">{{trans('lang.attributes')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('restaurants.dashboard.show',['id'=>$data->id,'type'=>'addons'])}}" class="nav-link @if($type =='addons')active @endif " >
                                    <span class="nav-text font-weight-bold">{{trans('lang.addons')}}</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a href="{{route('meals.index',['id'=>$data->id])}}" class="nav-link @if(Request()->routeIs('meals.index'))active @endif ">
                                    <span class="nav-text font-weight-bold">{{trans('lang.meals')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" >

                                    <span class="nav-text font-weight-bold">{{trans('lang.orders')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('restaurant_balance.index',['id'=>$data->id])}}" class="nav-link @if(Request()->routeIs('restaurant_balance .index'))active @endif " >
                                    <span class="nav-text font-weight-bold">{{trans('lang.balance')}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" >
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
                                @include('admin.restaurants.dashboard.meals')
                            @elseif($type == 'settings')
                                @include('admin.restaurants.dashboard.settings')
                            @elseif($type == 'balance')
                                @include('admin.restaurants.dashboard.balance')
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
