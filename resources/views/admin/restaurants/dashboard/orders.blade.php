<!--begin::Heading-->
@php
    $route = 'orders';
@endphp
<div class="card card-custom card-collapse" id="kt_card_1">

    <div class="card-header" style="display: inline-block;overflow-x: scroll">
        <a href="{{route('restaurant_orders.index',['id'=>$data->id , 'status' => null])}}">
            <h3 class="btn btn-{{$status == null ? 'success':'default' }} card-label">
                {{trans('lang.all_orders')}}
                <b class="badge badge-info ">{{count($allOrders)}}</b>
            </h3>
        </a>
        <a href="{{route('restaurant_orders.index',['id'=>$data->id , 'status' => 'incoming'])}}">
            <h3 class="btn btn-{{$status == 'incoming' ? 'success':'default' }} card-label">
                {{trans('lang.incoming_orders')}}
                <b class="badge badge-info ">{{count($incomingOrders)}}</b>
            </h3>
        </a>
        <a href="{{route('restaurant_orders.index',['id'=>$data->id , 'status' => 'on_processing'])}}">
            <h3 class="btn btn-{{$status == 'on_processing' ? 'success':'default' }} card-label">
                {{trans('lang.on_processing_orders')}}
                <b class="badge badge-info ">{{count($on_processingOrders)}}</b>
            </h3>
        </a>
        <a href="{{route('restaurant_orders.index',['id'=>$data->id , 'status' => 'on_delivery'])}}">
            <h3 class="btn btn-{{$status == 'on_delivery' ? 'success':'default' }} card-label">
                {{trans('lang.on_delivery_orders')}}
                <b class="badge badge-info ">{{count($on_deliveryOrders)}}</b>
            </h3>
        </a>
        <a href="{{route('restaurant_orders.index',['id'=>$data->id , 'status' => 'delivered'])}}">
            <h3 class="btn btn-{{$status == 'delivered' ? 'success':'default' }} card-label">
                {{trans('lang.delivered_orders')}}
                <b class="badge badge-info ">{{count($deliveredOrders)}}</b>
            </h3>
        </a>
        <a href="{{route('restaurant_orders.index',['id'=>$data->id , 'status' => 'cancelled'])}}">
            <h3 class="btn btn-{{$status == 'cancelled' ? 'success':'default' }} card-label">
                {{trans('lang.cancelled_orders')}}
                <b class="badge badge-info ">{{count($deliveredOrders)}}</b>
            </h3>
        </a>
    </div>

</div>

<div class="separator separator-dashed my-10"></div>
<!--begin::Heading-->
<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <h3 class="font-size-h6 mb-5">{{trans('lang.current_'.$route)}}</h3>
    </div>
</div>
<!--end::Heading-->

<div class="card card-custom">
    <!--begin::Header-->
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <div class="d-flex mb-8" style="justify-content: center;">

            <!--begin::Nav Tabs-->
            <ul class="dashboard-tabs nav nav-pills nav-danger row row-paddingless m-0 p-0" role="tablist">
{{--            @foreach($category_data as $row)--}}
{{--                <!--begin::Item-->--}}
{{--                    <li class="nav-item d-flex col flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">--}}
{{--                        <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center @if($category_id == $row->id) active @endif  "--}}
{{--                           href="{{route('meals.index',['id'=>$data->id,'category_id'=>$row->id])}}">--}}
{{--                            <span class="nav-icon py-2 w-auto">--}}
{{--                               <img style="width: 70px;" alt="Pic" src="{{$row->image}}"/>--}}
{{--                            </span>--}}
{{--                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">--}}
{{--                                {{$row->name}}--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <!--end::Item-->--}}
{{--                @endforeach--}}
            </ul>
            <!--end::Nav Tabs-->
        </div>
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                <tr class="text-left">
                    <th class="center">{{trans('lang.date')}}</th>
                    <th class="center">{{trans('lang.no_of_meals')}}</th>
                    <th class="center">{{trans('lang.total_price')}}</th>
                    <th class="center">{{trans('lang.sub_total')}}</th>
                    <th class="center">{{trans('lang.tax')}}</th>
                    <th class="center">{{trans('lang.fee')}}</th>
                    {{--                    <th class="center">{{trans('lang.status')}}</th>--}}
                    <th class="center" style="min-width: 160px">{{trans('lang.options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($meals as $row)
                    <tr>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{\Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i')}}</span>
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                @if($row->orderMeals)
                                {{sizeof($row->orderMeals)}}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->total_price}}</span>
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->sub_total}}</span>
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->tax}}</span>
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->fee}}</span>
                        </td>
                        {{--                        <td>--}}
                        {{--                          <span class="switch switch-icon">--}}
                        {{--                                    <label>--}}
                        {{--                                        <input onchange="update_active(this)" value="{{ $row->id }}"--}}
                        {{--                                               type="checkbox" <?php if ($row->active == 1) echo "checked";?>>--}}
                        {{--                                        <span></span>--}}
                        {{--                                    </label>--}}
                        {{--                                </span>--}}
                        {{--                        </td>--}}
                        <td class="center">
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2" id="edit"
                               data-editid="{{$row->id}}" data-name_ar="{{$row->name_ar}}"
                               data-name_en="{{$row->name_en}}" data-toggle="modal" data-target="#view_model"
                            >
                                <i class="icon-nm fas fa-eye"></i>
                            </a>
                            <a class="btn btn-icon btn-warning btn-circle btn-sm mr-2"
                            >
                                <i class="icon-nm fas fa-pencil-alt"></i>
                            </a>
                            <a onclick="return confirm('{{trans('lang.are_y_sure_delete')}}')"
                               href="{{route($route.'.delete',$row->id)}}"
                               class='btn btn-icon btn-danger btn-circle btn-sm mr-2'
                               title="{{trans('lang.delete')}}"><i
                                    class="icon-nm fas fa-trash"
                                    aria-hidden='true'></i></a>
                        </td>
                    </tr>

                    {{--    view model--}}
                    <div class="modal fade" id="view_model" data-backdrop="static" tabindex="-1" role="dialog"
                         aria-labelledby="staticBackdrop" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.order_details')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="card" style="width: 100%">
                                                <div class="card-body">
                                                    <!--begin::Section-->
                                                    <div class="card card-custom">
                                                        <div class="card-body p-0">
                                                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                                                                <thead>
                                                                <tr>
                                                                    <th class="center">رقم الطلب</th>
                                                                    <th class="center">تاريخ الطلب</th>
                                                                    <th class="center">العميل</th>
                                                                    <th class="center">المبلغ</th>
                                                                    <th class="center">حالة الطلب</th>
                                                                    <th class="center">الإجرائات</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>


                @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>

@push('scripts')


@endpush
