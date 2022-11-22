<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label"></label>
    <div class="col-lg-6 col-xl-6" style="text-align: center;">
        <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar">
            <div class="image-input-wrapper"
                 style="background-image: url({{$data->logo ?? asset('defaults/default_restaurant.png')}})"></div>
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
        <input class="form-control form-control-lg" type="text" name="name_ar"
               value="{{old('name_ar',$data->name_ar ?? null )}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.name_en')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg" type="text" name="name_en"
               value="{{old('name_en',$data->name_en ?? null )}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.crn')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg" type="text" name="crn"
               value="{{old('crn',$data->crn ?? null )}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.restaurant_type')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="restaurant_type_id" required id="restaurant_type_id" class="form-control custom-select col-12">
            @foreach($restaurant_types as $row)
                <option value="{{$row->id}}" @if(old('restaurant_type_id') == $row->id) selected @endif
                @if(Request()->segment(4) == 'info') @if($row->id == $data->restaurant_type_id) selected @endif @endif >{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
{{--<input class="form-control form-control-lg" required type="hidden" name="latitude"--}}
{{--       value="{{old('latitude',$data->latitude ?? '30.4551515' )}}"/>--}}
{{--<input class="form-control form-control-lg" required type="hidden" name="longitude"--}}
{{--       value="{{old('longitude',$data->longitude ?? '30.4551515' )}}"/>--}}
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
        <input class="form-control form-control-lg" type="text" name="full_name"
               value="{{old('full_name',$data->full_name ?? null )}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.national_id')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg" type="text" name="national_id"
               value="{{old('national_id',$data->national_id ?? null )}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.phone')}}</label>
    <div class="col-lg-9 col-xl-6">
        <div class="input-group input-group-lg @if(Request()->segment(4) == 'info') input-group-solid @endif ">
            <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-phone"></i>
                    </span>
            </div>
            <input type="text" name="phone"
                   class="form-control form-control-lg @if(Request()->segment(4) == 'info')form-control-solid @endif "
                   value="{{old('phone',$data->phone ?? null )}}" @if(Request()->segment(4) == 'info') readonly @endif
            />
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.nationality')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="nationality_id" required id="nationality_id" class="form-control custom-select col-12">
            @foreach($nationalities as $row)
                <option value="{{$row->id}}" @if(old('nationality_id') == $row->id) selected @endif
                @if(Request()->segment(4) == 'info') @if($row->id == $data->nationality_id) selected @endif @endif >{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.owner_type')}}</label>
    <div class="col-lg-9 col-xl-6">
        <select name="owner_type_id" required id="owner_type_id" class="form-control custom-select col-12">
            @foreach($owner_types as $row)
                <option value="{{$row->id}}" @if(old('owner_type_id') == $row->id) selected @endif
                @if(Request()->segment(4) == 'info')  @if($row->id == $data->owner_type_id) selected @endif @endif >{{$row->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="separator separator-dashed my-10"></div>
<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <h3 class="font-size-h6 mb-5">{{trans('lang.location_info')}}</h3>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.address')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg" type="text" name="address"
               value="{{old('address',$data->address ?? null )}}"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.address_on_map')}}</label>
    <div class="col-lg-9 col-xl-8">
        <div id="" class="form-group row">
            <div class="col-sm-12 ">
                <div id="us1" style="width:100%;height:400px;"></div>
            </div>
            <input required type="hidden" name="latitude" id="lat" value="{{old('address',$data->latitude ?? $lat )}}">
            <input required type="hidden" name="longitude" id="lng" value="{{old('address',$data->longitude ?? $lng )}}">
        </div>
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
        <div class="input-group input-group-lg @if(Request()->segment(4) == 'info') input-group-solid @endif ">
            <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-at"></i>
                    </span>
            </div>
            <input type="text" name="email"
                   class="form-control form-control-lg @if(Request()->segment(4) == 'info')form-control-solid @endif "
                   value="{{old('email',$data->email ?? null )}}" @if(Request()->segment(4) == 'info') readonly @endif
            />
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.password')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg" type="password" name="password"/>
    </div>
</div>
<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label">{{trans('lang.password_confirmation')}}</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control form-control-lg" type="password" name="password_confirmation"/>
    </div>
</div>

<div class="d-flex flex-center">
    <button type="submit" class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('lang.save')}}
    </button>
</div>

@push('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_user_avatar');
    </script>
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng({{$lat}},{{$lng}}),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("us1"), mapProp);
        }
    </script>
    <script
        src="http://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=myMap"></script>
    <script src="{{ asset('metronic/assets/js/locationpicker.jquery.js')}}"></script>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{$lat}},
                longitude: {{$lng}}
            },
            radius: 300,
            markerIcon: "{{url('/defaults/map-marker.png')}}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng')
            }
        });
    </script>
@endpush
