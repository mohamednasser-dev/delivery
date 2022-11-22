@extends('admin_temp')
@php
    $route = 'restaurants';
@endphp
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('lang.add')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route($route.'.index')}}" class="text-muted">{{trans('lang.'.$route)}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('home')}}" class="text-muted">{{trans('lang.home')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <?php

    $lat = '24.65442475109588';
    $lng = '46.709548950195305';
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{trans('lang.restaurant_info')}}</h4>
                    <hr>
                    {{ Form::open( ['route' => ['restaurants.store'],'method'=>'post', 'files'=>'true'] ) }}
                    @include('admin.restaurants.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
