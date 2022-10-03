@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.edit')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{url('/users')}}" class="text-muted">{{trans('s_admin.view_users')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
@endsection
@section('content')
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title">{{trans('admin.user_info')}}</h4>
                  <hr>
                  {!! Form::model($user_data, ['route' => ['users.update',$user_data->id] , 'method'=>'put','files'=> true]) !!}
{{--                  <div class="form-group m-t-40 row">--}}
{{--                      <label for="example-text-input" class="col-md-2 col-form-label" >{{trans('admin.user_name')}}</label>--}}
{{--                      <div class="col-md-10">--}}
{{--                          <input type="text" readonly value="{{$user_data->unique_name}}" onkeyup="this.value=removeSpaces(this.value);"  class="form-control" name="unique_name">--}}
{{--                      </div>--}}
{{--                  </div>--}}
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.full_name')}}</label>
                        <div class="col-md-10">
                          {{ Form::text('name',$user_data->name,["class"=>"form-control" ,"required"]) }}
                        </div>
                  </div>
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.phone')}}</label>
                      <div class="col-lg-3">
                          <input type="number" onkeyup="this.value=phonelimit(this.value);" required value="{{$user_data->phone}}" class="form-control" name="phone">
                      </div>
                      <div class="col-lg-2">
                          <div class="col-lg-1 col-md-1 col-sm-1">
                              <input id="txt_country_code" value="{{$user_data->country_code}}"
                                     class="form-control" required
                                     type="text" name="country_code"/>
                          </div>
                      </div>
                  </div>
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label">{{trans('admin.email')}}</label>
                        <div class="col-md-10">
                          {{ Form::email('email',$user_data->email,["class"=>"form-control" ,"required"]) }}
                        </div>
                  </div>
                  <div class="form-group row">
                      <label for="example-password-input" class="col-md-2 col-form-label">{{trans('admin.password')}}</label>
                        <div class="col-md-10">
                          <input class="form-control" type="password" name="password"  id="example-password-input">
                        </div>
                  </div>
                  <div class="form-group row">
                    <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('admin.password_confirmation')}}</label>
                      <div class="col-md-10">
                          <input class="form-control" type="password" name="password_confirmation"  id="example-password-input2">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('s_admin.gender')}}</label>
                      <div class="col-md-10">
                          <select required name="gender" class="form-control form-control-lg" id="exampleSelectl">
                              <option value="male" @if($user_data->gender == 'male') selected @endif >{{trans('admin.male')}}</option>
                              <option value="female" @if($user_data->gender == 'female') selected @endif >{{trans('admin.female')}}</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('admin.permission')}}</label>
                      <div class="col-md-10">
                        <select name="role_id" required id="cmb_role" class="form-control custom-select col-12">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @php if($user_data->role_id == $role->id) echo "selected"; @endphp >{{$role->name}}</option>
                            @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="form-group row"  id="college_cont" @if($user_data->role_id == 2 || $user_data->role_id == 8 || $user_data->role_id == 6 || $user_data->role_id == 7) style="display: none;" @endif >
                      <label for="example-password-input2" class="col-md-2 col-form-label">{{trans('s_admin.care')}}</label>
                      <div class="col-md-10">
                          <select name="college_id" class="form-control form-control-lg" id="cmb_collage">
                              @if($user_data->role_id != 2 && $user_data->role_id != 8 && $user_data->role_id != 6 && $user_data->role_id != 7)
                                  @if($user_data->role_id == 3 ||  $user_data->role_id == 9||  $user_data->role_id == 10||  $user_data->role_id == 11)
                                    @php $college_data = \App\Models\College::where('deleted','0')->where('type','college')->get(); @endphp
                                  @elseif($user_data->role_id == 5 ||  $user_data->role_id == 12 ||  $user_data->role_id == 13 ||  $user_data->role_id == 14)
                                      @php $college_data = \App\Models\College::where('deleted','0')->where('type','dorr')->get(); @endphp
                                  @endif
                                  @foreach($college_data as $row)
                                      @if($row->id == $user_data->college_id)
                                          <option value="{{$row->id}}" selected > @if( app()->getLocale() == 'ar') {{$row->name_ar}} @else {{$row->name_en}} @endif </option>
                                      @else
                                           <option value="{{$row->id}}"> @if( app()->getLocale() == 'ar') {{$row->name_ar}} @else {{$row->name_en}} @endif </option>
                                      @endif
                                  @endforeach
                              @endif
                          </select>
                      </div>
                  </div>
                  <div class="form-group m-t-40 row">
                      <label for="example-text-input" class="col-md-2 col-form-label" >{{trans('s_admin.work_place')}}</label>
                      <div class="col-md-10">
                          <input type="text" required class="form-control" name="work_place" value="{{$user_data->work_place}}">
                      </div>
                  </div>
                  <div class="center">
                    {{ Form::submit( trans('admin.public_Edit') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                  </div>
                   {{ Form::close() }}
              </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            // var code = "+966"; // Assigning value from model.
            var code = "+966";
            $('#txt_country_code').val(code);
            $('#txt_country_code').intlTelInput({
                autoHideDialCode: true,
                autoPlaceholder: "ON",
                dropdownContainer: document.body,
                formatOnDisplay: true,
                hiddenInput: "full_number",
                initialCountry: "auto",
                nationalMode: true,
                placeholderNumberType: "MOBILE",
                preferredCountries: ['US'],
                separateDialCode: false
            });
            // console.log(code)
            // $("#txt_unique_name").keyup(function (event) {
            //     var txt_unique_name = $("#txt_unique_name").val('');
            //     txt_unique_name.replace(/\s/g, "") ;
            // });
        });
        function removeSpaces(string) {
            return string.split(' ').join('');
        }

        $('#cmb_role').change(function(){
            var role_id = $(this).val();
            $.ajax({
                url: "/get_collage_by_role_id/" + role_id ,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    if(data == 1){
                        $('#college_cont').hide();
                    }else{
                        $('#college_cont').show();
                        $('#cmb_collage').html(data);
                    }

                }
            });
        });
        function phonelimit(string) {
            var first_string = string.substring(0);
            var int_string = parseInt(first_string);
            if(int_string == 0){
                $("#phone").val('');
                return false;
            }

            if (string.length < 11) {
                return string;
            } else {
                alert('عفوا رقم الجوال 10 اراقم فقط');
            }
        }
    </script>
@endsection

