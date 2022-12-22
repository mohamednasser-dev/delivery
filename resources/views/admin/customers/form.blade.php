<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>{{trans('lang.data')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group m-t-40 row">
                    <label class="col-md-2 col-form-label">{{trans('lang.image')}}</label>
                    <div class="col-md-10">
                        <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar">
                            <div class="image-input-wrapper"
                                 style="background-image: url({{ $data->image ?? asset('defaults/user_default.png') }})"></div>
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
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.full_name')}}</label>
                    <div class="col-md-10">
                        {{ Form::text('name',old('name',$data->name ?? null ),["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.email')}}</label>
                    <div class="col-md-10">
                        {{ Form::email('email',old('email',$data->email ?? null ),["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.phone')}}</label>
                    <div class="col-lg-10">
                        <input type="text" onkeyup="this.value=phonelimit(this.value);" required
                               value="{{old('phone',$data->phone ?? null )}}" class="form-control" name="phone">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-password-input"
                           class="col-md-2 col-form-label">{{trans('admin.password')}}</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" name="password" id="example-password-input"
                               @if(Request()->segment(2) != 'edit') required @endif >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-password-input2"
                           class="col-md-2 col-form-label">{{trans('admin.password_confirmation')}}</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" name="password_confirmation"
                               id="example-password-input2" @if(Request()->segment(2) != 'edit') required @endif>
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
