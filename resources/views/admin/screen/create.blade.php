@php($title='اضافة شاشة ترحيبية جديدة')
@extends('admin_temp')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-warning font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('screens')}}"
                   class="text-muted">الشاشات الترحيبية</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('screens.store')}}" enctype="multipart/form-data" files="true">
                @csrf
               @include('dashboard.screen.form')
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection

