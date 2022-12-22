@extends('admin_temp')
@php
    $route = 'customers';
@endphp
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('lang.addresses')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('customers.index')}}" class="text-muted">{{trans('lang.customers')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('home')}}" class="text-muted">{{trans('lang.home')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Start home table -->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th class="center">{{trans('lang.main_address')}}</th>
                            <th class="center">{{trans('lang.title')}}</th>
                            <th class="center">{{trans('lang.address')}}</th>
                            <th class="center">{{trans('lang.map_location')}}</th>
{{--                            <th class="center" width="10%">{{trans('lang.options')}}</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $row)
                            <tr>
                                <td class="center">{{ $row->main}}</td>
                                <td class="center">{{ $row->title}}</td>
                                <td class="center">{{ $row->address}}</td>
                                <td class="center">
                                    <a href="https://maps.google.com/maps?q={{$row->lat}},{{$row->lng}}&hl=es&z=14&amp;"
                                       target="_blank" class="btn btn-primary"
                                       title="{{$row->address}}">
                                        <i class="fa fa-map"></i>
                                    </a>
                                </td>
{{--                                <td class="text-lg-center">--}}
{{--                                    <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2" id="edit"--}}
{{--                                       href="{{route( $route.'.edit' , $row->id )}}">--}}
{{--                                        <i class="icon-nm fas fa-pencil-alt"></i>--}}
{{--                                    </a>--}}
{{--                                    <a onclick="return confirm('{{trans('lang.are_y_sure_delete')}}')"--}}
{{--                                       href="{{route($route.'.destroy',$row->id)}}"--}}
{{--                                       class='btn btn-icon btn-danger btn-circle btn-sm mr-2'--}}
{{--                                       title="{{trans('lang.delete')}}"><i--}}
{{--                                            class="icon-nm fas fa-trash"--}}
{{--                                            aria-hidden='true'></i></a>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
