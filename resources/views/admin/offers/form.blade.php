<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>{{trans('lang.data')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12" style="text-align: center;">
                        {{--        <label class="text-center col-form-label"></label>--}}
                        <div class="image-input image-input-outline image-input-circle" id="kt_image">
                            <div class="image-input-wrapper"
                                 style="background-image: url({{$data->image ?? asset('defaults/default_category.png')}})"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                   data-action="change" data-toggle="tooltip" title=""
                                   data-original-title="{{trans('lang.change_logo')}}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                <input type="hidden" name="profile_avatar_remove"/>
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                  data-action="cancel" data-toggle="tooltip" title="{{trans('lang.cancel')}}">
                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                </span>
                        </div>
                        <span
                            class="form-text text-dark-75 font-size-lg font-weight-bolder">{{trans('lang.offer_image')}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('lang.name_ar')}}
                                <span class="text-danger">*</span></label>
                            {{ Form::text('name_ar',old('name_ar',$data->name_ar ?? null),["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('lang.name_en')}}
                                <span class="text-danger">*</span></label>
                            {{ Form::text('name_en',old('name_en',$data->name_en ?? null),["class"=>"form-control" ,"required"]) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('lang.type')}}
                                <span class="text-danger">*</span></label>
                            <select name="target_type" required id="cmb_type"
                                    class="form-control custom-select col-12">
                                <option
                                    value="{{\App\Models\Restaurant::class}}" @if( request()->segment(2) == 'edit' ) {{ $data->target_type == \App\Models\Restaurant::class ? 'selected' : '' }} @endif >{{trans('lang.restaurant')}}</option>
                                <option
                                    value="{{\App\Models\Meal::class}}" @if( request()->segment(2) == 'edit' ) {{ $data->target_type == \App\Models\Meal::class ? 'selected' : '' }} @endif >{{trans('lang.meal')}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" id="restaurant_cont" @if( request()->segment(2) == 'edit' ) @if( $data->target_type != \App\Models\Restaurant::class ) style="display: none;"
                         @endif @endif>
                        <div class="form-group">
                            <label>{{trans('lang.the_restaurant')}}
                                <span class="text-danger">*</span></label>
                            <select name="target_id" required id="kt_select2_1" style="width: 100%"
                                    class="form-control custom-select select2 col-12">
                                @foreach($restaurants as $row)
                                    <option
                                        value="{{$row->id}}" @if( request()->segment(2) == 'edit' ) {{ $data->target_id == $row->id ? 'selected' : '' }} @endif >{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" id="meal_cont"
                         @if( request()->segment(2) == 'edit' ) @if( $data->target_type != \App\Models\Meal::class ) style="display: none;"
                         @endif @else style="display: none;" @endif >
                        <div class="form-group">
                            <label>{{trans('lang.the_meal')}}
                                <span class="text-danger">*</span></label>
                            <select name="target_id" required id="kt_select2_3" style="width: 100%"
                                    class="form-control custom-select select2 col-12">
                                @foreach($meals as $row)
                                    <option
                                        value="{{$row->id}}" @if( request()->segment(2) == 'edit' ) {{ $data->target_id == $row->id ? 'selected' : '' }} @endif >{{$row->name}}
                                        &nbsp;&nbsp; ({{$row->restaurant->name}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="center">
                    {{ Form::submit( trans('lang.save') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image');


        $('#cmb_type').change(function () {
            var type = $(this).val();
            console.log(type);
            if (type == 'App\\Models\\Restaurant') {
                $('#restaurant_cont').show();
                $('#meal_cont').hide();
            } else {
                $('#meal_cont').show();
                $('#restaurant_cont').hide();
            }
        });
    </script>
@endpush
