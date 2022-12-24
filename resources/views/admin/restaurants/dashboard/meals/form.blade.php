<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.image')}}</label>
    <div class="col-lg-9 col-xl-9">
        <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar">
            <div class="image-input-wrapper"
                 style="background-image: url({{$meal->image ?? asset('defaults/default_meal.png')}})"></div>
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
        <input class="form-control form-control-lg" type="text" name="name_ar"
               placeholder="مثال : بيتزا" value="{{old('name_ar',$meal->name_ar ?? null)}}" required/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_en')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg  " type="text" name="name_en"
               placeholder="مثال: pizza" value="{{old('name_en',$meal->name_en ?? null)}}" required/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.price')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg  " type="number" name="price" min="0"
               placeholder="مثال: 35.00" value="{{old('price',$meal->price ?? null)}}" max="999999999999.99" step="any"
               required/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.category')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="category_id" required id="cmb_role"
                class="form-control   custom-select col-12">
            @foreach($category_data as $row)
                <option
                    value="{{$row->id}}" @if( request()->segment(2) == 'edit' ) {{ $meal->category_id == $row->id ? 'selected' : '' }} @endif >{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.desc_ar')}}</label>
    <div class="col-lg-9 col-xl-6">
                    <textarea class="form-control  " placeholder="" id="exampleTextarea" rows="3"
                              name="desc_ar">{{old('desc_ar',$meal->desc_ar ?? null)}}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.desc_en')}}</label>
    <div class="col-lg-9 col-xl-6">
                    <textarea class="form-control  " placeholder="" id="exampleTextarea" rows="3"
                              name="desc_en">{{old('desc_en',$meal->desc_en ?? null)}}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.attributes')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control select2" id="kt_select2_3" style="width: 100%;"
                name="attributes[]" multiple="multiple">
            @foreach($attribute_data as $row)
                <option value="{{$row->id}}"
                        @if( request()->segment(2) == 'edit' )  @if(in_array( $row->id, $meal_attributes_ids)) selected @endif @endif >{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="attributes_section">
    {{--old attributes--}}
    @if( request()->segment(2) == 'edit' )
        @foreach($meal_attributes as $meal_attr)
            <div class="row">
                <div class="col-md-3">
                    <label class="form-control">{{$meal_attr->attribute->name}}</label>
                </div>
                <div class="col-md-9" id="options_container_{{$meal_attr->attribute->id}}">
                    @foreach($meal_attr->attribute->options as $key=> $row)
                        <div class="row" id="option_row_{{$row->id}}">
                            <div class="col-md-26">
                                <a href="javascript:void(0);"
                                   onclick="delete_option({{$row->id}},{{$meal_attr->attribute->id}})">
                                    <i title="{{trans('lang.remove_option')}}" style="color: red;margin-top: 10px;"
                                       class="fa fa-trash"></i>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="attr_options_ids[{{$meal_attr->attribute->id}}][]"
                                       value="{{$row->id}}">
                                <input type="text" readonly class="form-control form-control-solid"
                                       name="option_names[]"
                                       value="{{$row->name}}">
                            </div>
                            @php
                                $meal_attr_option = \App\Models\MealAttributeOption::where('meal_id',$meal->id)->where('option_id',$row->id)->first();
                            @endphp
                            @if($meal_attr_option)
                            <div class="col-md-6">
                                <input type="number" min="0" max="999999999999.00" step="any" class="form-control"
                                       required
                                       name="option_prices[{{$row->id}}][]" value="{{$meal_attr_option->price}}"
                                       placeholder="{{trans('lang.price')}}">
                            </div>
                            @else
                                <div class="col-md-6">
                                    <input type="number" min="0" max="999999999999.00" step="any" class="form-control"
                                           required
                                           name="option_prices[{{$row->id}}][]" value="0"
                                           placeholder="{{trans('lang.price')}}">
                                </div>
                                @endif
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
            <hr>
        @endforeach
    @endif
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.addons')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select class="form-control select2" id="kt_select2_2" style="width: 100%;"
                name="addons[]" multiple="multiple">
            @foreach($addons_data as $row)
                <option value="{{$row->id}}"
                        @if( request()->segment(2) == 'edit' )  @if(in_array( $row->id, $meal_addons_ids)) selected @endif @endif >{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="addons_section">
    @if( request()->segment(2) == 'edit' )
        @foreach($meal_addons as $meal_addon)
            <div class="row">
                <div class="col-md-3">
                    <label class="form-control" >{{$meal_addon->addon->name}}</label>
                    <input type="hidden"  name="addon_ids[]" value="{{$meal_addon->addon->id}}" >
                </div>
                <div class="col-md-9">
                    <div class="row">
                        @php
                            $meal_addon_data = \App\Models\MealAddon::where('meal_id',$meal->id)->where('addon_id',$meal_addon->addon->id)->first();
                        @endphp
                        @if($meal_addon_data)
                        <div class="col-md-12">
                            <input required type="number" value="{{$meal_addon_data->price}}" min="0" max="999999999999.00" step="any" class="form-control" name="prices[]" placeholder="{{trans('lang.price')}}"
                            >
                        </div>
                        @else
                            <div class="col-md-12">
                                <input required type="number" value="0" min="0" max="999999999999.00" step="any" class="form-control" name="prices[]" placeholder="{{trans('lang.price')}}"
                                >
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br>

        @endforeach
    @endif
</div>
<div class="d-flex flex-center">
    <button type="submit"
            class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('lang.save')}}
    </button>
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
@endpush
