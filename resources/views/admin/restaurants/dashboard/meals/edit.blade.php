@extends('admin_temp')
@php
    $route = 'meals';
@endphp
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('lang.edit')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route($route.'.index',$data->id)}}" class="text-muted">{{trans('lang.'.$route)}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('home')}}" class="text-muted">{{trans('lang.home')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($data, ['route' => [$route.'.update_new', $data->id] , 'method'=>'put','files'=> true]) !!}
            @include('admin.restaurants.dashboard.meals.form')
            {{ Form::close() }}
        </div>
    </div>
@endsection
