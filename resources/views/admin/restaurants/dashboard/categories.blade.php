<!--begin::Heading-->
@php
    $route = 'categories';
@endphp
<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <h3 class="font-size-h6 mb-5">{{trans('lang.add_new_category')}}</h3>
    </div>
</div>
<!--end::Heading-->
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
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                <tr class="text-left">
                    <th class="center">{{trans('lang.name_ar')}}</th>
                    <th class="center">{{trans('lang.name_en')}}</th>
                    {{--                    <th class="center">{{trans('lang.status')}}</th>--}}
                    <th class="center" style="min-width: 160px">{{trans('lang.options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $row)
                    <tr>
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
                            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2" id="edit"
                               data-editid="{{$row->id}}" data-name_ar="{{$row->name_ar}}"
                               data-name_en="{{$row->name_en}}" data-toggle="modal" data-target="#edit_model"
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
@push('scripts')
    <script type="text/javascript">
        function update_active(el) {
            if (el.checked) {
                var status = 'y';
            } else {
                var status = 'n';
            }
            $.post('{{ route('categories.change_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    toastr.success("{{trans('s_admin.statuschanged')}}");
                } else {
                    toastr.error("{{trans('s_admin.statuschanged')}}");
                }
            });
        }
    </script>
    <script>
        var id;
        $(document).on('click', '#edit', function () {
            id = $(this).data('editid');
            name_ar = $(this).data('name_ar');
            name_en = $(this).data('name_en');
            type = $(this).data('type');
            $('#txt_id').val(id);
            $('#txt_name_ar').val(name_ar);
            $('#txt_name_en').val(name_en);
            $('#select_type').val(type);
        });
    </script>
@endpush
