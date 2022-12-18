<!--begin::Heading-->
@php
    $route = 'meals';
@endphp
<div class="card card-custom  card-collapse" id="kt_card_1">
    <div class="card-header">
        <div class="card-title">
            <a href="#" data-card-tool="toggle"
               data-toggle="tooltip" data-placement="top">
                <h3 class="btn btn-success"><i class="fa fa-plus"></i> {{trans('lang.add_new_meal')}}</h3>
            </a>
        </div>
    </div>
    <div class="card-body" style="display: none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;">
        <form class="form" method="POST" action="{{route($route.'.store',['id'=>$data->id])}}" enctype="multipart/form-data">
            @csrf
            @include('admin.restaurants.dashboard.meals.form')
        </form>
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
            @foreach($category_data as $row)
                <!--begin::Item-->
                    <li class="nav-item d-flex col flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">
                        <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center @if($category_id == $row->id) active @endif  "
                           href="{{route('meals.index',['id'=>$data->id,'category_id'=>$row->id])}}">
                            <span class="nav-icon py-2 w-auto">
                               <img style="width: 70px;" alt="Pic" src="{{$row->image}}"/>
                            </span>
                            <span class="nav-text font-size-lg py-2 font-weight-bold text-center">
                                {{$row->name}}
                            </span>
                        </a>
                    </li>
                    <!--end::Item-->
                @endforeach
            </ul>
            <!--end::Nav Tabs-->
        </div>
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_datatable">
                <thead>
                <tr class="text-left">
                    <th class="center">{{trans('lang.image')}}</th>
                    <th class="center">{{trans('lang.name_ar')}}</th>
                    <th class="center">{{trans('lang.name_en')}}</th>
                    {{--                    <th class="center">{{trans('lang.status')}}</th>--}}
                    <th class="center" style="min-width: 160px">{{trans('lang.options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($meals as $row)
                    <tr>
                        <td class="center">
                            <img class="img-thumbnail rounded-circle" src="{{$row->image}}"
                                 style="height: 75px; width: 75px;">
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->name_ar}}</span>
                        </td>
                        <td class="center">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->name_en}}</span>
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
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2"
                               href="{{route($route.'.edit',$row->id)}}"
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
                @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
{{--    edit model--}}
<div class="modal fade" id="edit_model" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="t*ue">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open( ['route' =>$route.'.update_new','method'=>'post', 'files'=>'true'] ) }}
                <input type="hidden" required class="form-control" id="txt_id" name="id">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
                        <div class="col-lg-8">
                            <input type="text" required class="form-control" id="txt_name_ar" name="name_ar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
                        <div class="col-lg-8">
                            <input type="text" required class="form-control" id="txt_name_en" name="name_en">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

