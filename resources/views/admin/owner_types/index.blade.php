@extends('admin_temp')
@php
    $route = 'owner_types';
@endphp
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('lang.'.$route)}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
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
                <div class="card-header">
                    <a href="{{url($route.'/create')}} "
                       class="btn btn-info btn-bg">
                        <i class="fa fa-plus"></i>
                        {{trans('lang.add')}}</a>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th class="center" width="10%">#</th>
                            <th class="center">{{trans('lang.name_ar')}}</th>
                            <th class="center">{{trans('lang.name_en')}}</th>
                            <th class="center" width="10%">{{trans('lang.options')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $row)
                            <tr>
                                <td class="center">{{ $key+1 }}</td>
                                <td class="center">{{ $row->name_ar}}</td>
                                <td class="center">{{ $row->name_en}}</td>
                                <td class="text-lg-center">
                                    <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2" id="edit"
                                       href="{{route( $route.'.edit' , $row->id )}}">
                                        <i class="icon-nm fas fa-pencil-alt"></i>
                                    </a>
                                    <a onclick="return confirm('{{trans('lang.are_y_sure_delete')}}')"
                                       href="{{url($route.'/'.$row->id.'/delete_ew')}}"
                                       class='btn btn-icon btn-danger btn-circle btn-sm mr-2' title="{{trans('lang.delete')}}"><i
                                            class="icon-nm fas fa-trash"
                                            aria-hidden='true'></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
