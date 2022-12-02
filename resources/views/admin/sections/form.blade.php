<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>{{trans('lang.data')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('lang.name_ar')}}</label>
                    <div class="col-md-10">
                        {{ Form::text('name_ar',old('name_ar',$data->name_ar ?? null),["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('lang.name_en')}}</label>
                    <div class="col-md-10">
                        {{ Form::text('name_en',old('name_en',$data->name_en ?? null),["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('lang.image')}}</label>
                    <div class="col-md-10">
                        <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar">
                            <div class="image-input-wrapper"
                                 style="background-image: url({{ $data->image ?? asset('defaults/default_meal.png') }})"></div>
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
                <div class="center">
                    {{ Form::submit( trans('lang.save') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_user_avatar');
    </script>
@endpush
