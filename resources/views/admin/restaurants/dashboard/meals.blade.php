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
{{--        <div class="card-toolbar">--}}
{{--            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle"--}}
{{--               data-toggle="tooltip" data-placement="top" title="{{trans('lang.add_new_meal')}}">--}}
{{--                <i class="ki ki-arrow-down icon-nm"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
    <div class="card-body" style="display: none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;">
        <form class="form" method="POST" action="{{route($route.'.store',['id'=>$data->id])}}">
            @csrf
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.image')}}</label>
                <div class="col-lg-9 col-xl-9">
                    <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar">
                        <div class="image-input-wrapper"
                             style="background-image: url({{asset('defaults/default_meal.png')}})"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                               data-action="change" data-toggle="tooltip" title=""
                               data-original-title="{{trans('lang.add_image')}}">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="profile_avatar_remove"/>
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="cancel" data-toggle="tooltip" title="{{trans('lang.cancel')}}">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_ar')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg  " type="text" name="name_ar"
                           placeholder="مثال : بيتزا" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_en')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg  " type="text" name="name_en"
                           placeholder="مثال: pizza" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.price')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg  " type="number" name="price" min="0"
                           placeholder="مثال: 35.00" max="999999999999.99" step="any" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.category')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <select name="category_id" required id="cmb_role"
                            class="form-control   custom-select col-12">
                        @foreach($category_data as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.desc_ar')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <textarea class="form-control  " placeholder="" id="exampleTextarea" rows="3"
                              name="desc_ar"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.desc_en')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <textarea class="form-control  " placeholder="" id="exampleTextarea" rows="3"
                              name="desc_en"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.attributes')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <select class="form-control select2" id="kt_select2_3" style="width: 100%;"
                            name="attributes[]" multiple="multiple">
                        @foreach($attribute_data as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="attributes_section"></div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.addons')}}</label>
                <div class="col-lg-9 col-xl-6">
                    <select class="form-control select2" id="kt_select2_2" style="width: 100%;"
                            name="addons[]" multiple="multiple">
                        @foreach($addons_data as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="addons_section"></div>
            <div class="d-flex flex-center">
                <button type="submit"
                        class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('lang.save')}}
                </button>
            </div>
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
                @foreach($meals as $row)
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
    <script>
        $('#kt_select2_3').on('change', function () {
            $('#attributes_section').html(null);
            $.each($("#kt_select2_3 option:selected"), function () {
                if ($(this).val().length > 50) {
                    toastr.error(
                        '{{ trans('validation.max.string', ['attribute' => trans('lang.variation'), 'max' => '50']) }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    return false;
                }
                // add_more_customer_choice_option($(this).val(), $(this).text());
                $.ajax({
                    url: '{{ route('meals.attribute.data') }}',
                    type: "get",
                    data: {
                        _token: $("#csrf").val(),
                        attribute_id: $(this).val(),
                    },
                    cache: false,
                    success: function (data) {
                        $('#attributes_section').append(data);
                    }
                });
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name;
            $('#attributes_section').append(
                '<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i +
                '"><input type="text" class="form-control" name="choice[]" value="' + n +
                '" placeholder="{{ trans('lang.choice_title') }}" readonly></div><div class="col-md-9"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="{{ trans('lang.enter_choice_values') }}" data-role="tagsinput" onchange="combination_update()"></div></div><br>'
            );
        }

        $('#kt_select2_2').on('change', function () {
            $('#addons_section').html(null);
            $.each($("#kt_select2_2 option:selected"), function () {
                if ($(this).val().length > 50) {
                    toastr.error(
                        '{{ trans('validation.max.string', ['attribute' => trans('lang.variation'), 'max' => '50']) }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    return false;
                }
                // add_more_customer_choice_option($(this).val(), $(this).text());
                $.ajax({
                    url: '{{ route('meals.addon.data') }}',
                    type: "get",
                    data: {
                        _token: $("#csrf").val(),
                        addon_id: $(this).val(),
                    },
                    cache: false,
                    success: function (data) {
                        $('#addons_section').append(data);
                    }
                });
            });
        });
    </script>
    <script !src="">
        var avatar1 = new KTImageInput('kt_user_avatar');
    </script>
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

        function delete_option(i, attribute_id) {
            $('#option_row_' + i).remove();
            //check if all options removed or not to remove main attribute
            if ($('#addons_section').html() == null) {
                $('#options_container_' + attribute_id).remove();
            }
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
