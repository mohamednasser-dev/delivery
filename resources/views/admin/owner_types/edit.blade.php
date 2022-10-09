@extends('admin_temp')
@php
    $route = 'owner_types';
@endphp
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('lang.edit')}}</h5>
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
    <form method="post" action="{{ route($route.'.update', $data->id) }}">
        @csrf
        @include('admin.'.$route.'.form')
    </form>
@endsection
