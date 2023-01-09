@extends('admin_temp')
@php
    $route = 'reviews';
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
@section('styles')
    <style>
        .checked {
            color: orange;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                            <thead>
                            <tr>
                                <th style="text-align: center;" title="Field #2">المطعم</th>
                                <th style="text-align: center;" title="Field #2">المستخدم</th>
                                <th style="text-align: center;" title="Field #2">التعليق</th>
                                <th style="text-align: center;" title="Field #2">التقييم</th>
                                <th style="text-align: center;" title="Field #2">التاريخ</th>
                                <th style="text-align: center;" title="Field #2">حالة الطلب</th>
                                <th style="text-align: center;" title="Field #7">الموافقة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $row)
                                <tr>
                                    <td style="text-align: center;">
                                        <a
                                            href="{{route('restaurants.dashboard.show',['id'=>$row->restaurant_id,'type'=>'info'])}}">
                                            {{$row->restaurant->name}}
                                        </a>
                                    </td>
                                    <td style="text-align: center;"> {{$row->customer->name}}</td>
                                    <td style="text-align: center;"> {{$row->comment}}</td>
                                    <td style="text-align: center;">{{$row->created_at->format('Y-m-d')}}</td>
                                    <td style="text-align: center;">
                                        <div>
                                            <span
                                                class="fa fa-star @if($row->rate == 1 || $row->rate == 2  || $row->rate == 3 || $row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                            <span
                                                class="fa fa-star @if( $row->rate == 2  || $row->rate == 3 || $row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                            <span
                                                class="fa fa-star @if( $row->rate == 3 || $row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                            <span
                                                class="fa fa-star @if($row->rate == 4 || $row->rate == 5) checked @endif "></span>
                                            <span class="fa fa-star @if($row->rate == 5) checked @endif "></span>
                                            <span>( {{$row->rate}} )</span>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">{{$row->status_text}}</td>
                                    <td style="text-align: center;">
                                        <div class="row">
                                            @if($row->status == 'rejected' || $row->status == 'pending')
                                                <div class="col-md-6">
                                                    <a
                                                        href="{{route('reviews.change_status',['status'=>'accepted','id'=>$row->id])}}"
                                                        class="btn btn-success">موافقة
                                                        <i class="fa fa-check"> </i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if($row->status == 'accepted' || $row->status == 'pending')
                                                <div class="col-md-6">
                                                    <a href="{{route('reviews.change_status',['status'=>'rejected','id'=>$row->id])}}"
                                                       class="btn btn-danger">
                                                        رفض
                                                        <i class=" flaticon2-delete"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
