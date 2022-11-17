@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.add')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{url('/users')}}" class="text-muted">{{trans('s_admin.view_users')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
@endsection
@section('content')
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">{{trans('admin.user_info')}}</h4>
                  <hr>
                  {{ Form::open( ['url'  => ['users'],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                 @include('admin.users.form')
                   {{ Form::close() }}
              </div>
          </div>
      </div>
  </div>
@endsection
