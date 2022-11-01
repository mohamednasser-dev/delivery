@extends('admin_temp')
@php
    $route = 'options';
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
                    <form class="form" method="POST" action="{{route($route.'.store',['id'=>$data->id])}}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_ar')}}</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text" name="name_ar" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_en')}}</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-lg form-control-solid" type="text" name="name_en" required/>
                            </div>
                        </div>
                        <div class="d-flex flex-center">
                            <button type="submit" class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('lang.save')}}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <!-- Start home table -->
                    <div class="table-responsive">
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
                                           href="{{url($route.'/'.$row->id.'/delete')}}"
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
    </div>
@endsection
