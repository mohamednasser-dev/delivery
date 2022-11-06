{{ Form::open( ['route' => ['restaurants.update',['id'=>$data->id]],'method'=>'post', 'files'=>'true'] ) }}
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.logo')}}</label>
    <div class="col-lg-9 col-xl-9">
        <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar">
            <div class="image-input-wrapper" style="background-image: url({{$data->logo}})"></div>
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                   data-action="change" data-toggle="tooltip" title=""
                   data-original-title="{{trans('lang.change_logo')}}">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="logo" accept=".png, .jpg, .jpeg"/>
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
        <input class="form-control form-control-lg form-control-solid" type="text" name="name_ar"
               value="{{$data->name_ar}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_en')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="text" name="name_en"
               value="{{$data->name_en}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.crn')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="text" name="crn"
               value="{{$data->crn}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.restaurant_type')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="restaurant_type_id" required id="restaurant_type_id" class="form-control custom-select col-12">
            @foreach($restaurant_types as $row)
                <option value="{{$row->id}}"
                        @if($row->id == $data->restaurant_type_id) selected @endif>{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<input class="form-control form-control-lg form-control-solid" required type="hidden" name="latitude"
       value="{{$data->latitude}}"/>
<input class="form-control form-control-lg form-control-solid" required type="hidden" name="longitude"
       value="{{$data->longitude}}"/>
<div class="separator separator-dashed my-10"></div>
<!--begin::Heading-->
<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <h3 class="font-size-h6 mb-5">{{trans('lang.personal_data_info')}}</h3>
    </div>
</div>
<!--end::Heading-->
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.full_name')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="text" name="full_name"
               value="{{$data->full_name}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.national_id')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="text" name="national_id"
               value="{{$data->national_id}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.phone')}}</label>
    <div class="col-lg-9 col-xl-6">
        <div class="input-group input-group-lg input-group-solid">
            <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-phone"></i>
                    </span>
            </div>
            <input type="text" name="phone" class="form-control form-control-lg form-control-solid" value="{{$data->phone}}" readonly
            />
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.nationality')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="nationality_id" required id="nationality_id" class="form-control custom-select col-12">
            @foreach($nationalities as $row)
                <option value="{{$row->id}}"
                        @if($row->id == $data->nationality_id) selected @endif>{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.owner_type')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="owner_type_id" required id="owner_type_id" class="form-control custom-select col-12">
            @foreach($owner_types as $row)
                <option value="{{$row->id}}"
                        @if($row->id == $data->owner_type_id) selected @endif>{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="separator separator-dashed my-10"></div>
<!--begin::Heading-->
<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <h3 class="font-size-h6 mb-5">{{trans('lang.login_info')}}</h3>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.email')}}</label>
    <div class="col-lg-9 col-xl-6">
        <div class="input-group input-group-lg input-group-solid">
            <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-at"></i>
                    </span>
            </div>
            <input type="text" name="email" class="form-control form-control-lg form-control-solid" value="{{$data->email}}" readonly
            />
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.password')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="password" name="password"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.password_confirmation')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation"/>
    </div>
</div>

<div class="d-flex flex-center">
    <button type="submit" class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('lang.save')}}
    </button>
</div>
{{ Form::close() }}
@push('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_user_avatar');
    </script>
@endpush
