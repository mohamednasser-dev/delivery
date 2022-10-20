@extends('admin_temp')
@php
    $route = 'restaurants';
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
                    {{--                    <a href="{{url($route.'/create')}} "--}}
                    {{--                       class="btn btn-info btn-bg">--}}
                    {{--                        <i class="fa fa-plus"></i>--}}
                    {{--                        {{trans('lang.add')}}</a>--}}
                    {{--                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>--}}

                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th class="center">{{trans('lang.logo')}}</th>
                            <th class="center">{{trans('lang.restaurant_name')}}</th>
                            <th class="center">{{trans('lang.restaurant_type')}}</th>
                            <th class="center">{{trans('lang.full_name')}}</th>
                            <th class="center">{{trans('lang.nationality')}}</th>
                            <th class="center">{{trans('lang.email')}}</th>
                            <th class="center">{{trans('lang.phone')}}</th>
                            <th class="center">{{trans('lang.owner_type')}}</th>
                            <th class="center">{{trans('lang.approval')}}</th>
                            <th class="center" width="10%">{{trans('lang.options')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $row)
                            <tr>
                                <td class="center">
                                    <img class="img-thumbnail" src="{{$row->logo}}"
                                         style="height: 75px; width: 75px;">
                                </td>
                                <td class="center">{{ $row->name}}</td>
                                <td class="center">{{ $row->type->name}}</td>
                                <td class="center">{{ $row->full_name}}</td>
                                <td class="center">{{ $row->nationality->name}}</td>
                                <td class="center">{{ $row->email}}</td>
                                <td class="center">{{ $row->phone}}</td>
                                <td class="center">{{ $row->owner_type->name}}</td>
                                <td class="center">
                                    <div class="btn-group">
                                        @if($row->status == 'pending')
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.new')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{route('restaurants.change_status',['id'=>$row->id,'status'=>'accepted'])}}">{{trans('s_admin.accept')}}</a>
                                                <a class="dropdown-item"
                                                   href="{{route('restaurants.change_status',['id'=>$row->id,'status'=>'rejected'])}}">{{trans('s_admin.reject')}}</a>
                                            </div>
                                        @elseif($row->status == 'accepted')
                                            <button type="button" class="btn btn-success dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.accepted')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{route('restaurants.change_status',['id'=>$row->id,'status'=>'rejected'])}}">{{trans('s_admin.reject')}}</a>
                                            </div>
                                        @elseif($row->status == 'rejected')
                                            <button type="button" class="btn btn-danger dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.rejected')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{route('restaurants.change_status',['id'=>$row->id,'status'=>'accepted'])}}">{{trans('s_admin.accept')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-lg-center">
                                    <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2" id="edit"
                                       href="{{route( $route.'.edit' , $row->id )}}">
                                        <i class="icon-nm fas fa-pencil-alt"></i>
                                    </a>
                                    <a onclick="return confirm('{{trans('lang.are_y_sure_delete')}}')"
                                       href="{{url($route.'/'.$row->id.'/delete_ew')}}"
                                       class='btn btn-icon btn-danger btn-circle btn-sm mr-2'
                                       title="{{trans('lang.delete')}}"><i
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
