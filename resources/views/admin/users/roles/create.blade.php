@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.add_new_role')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{url('/roles')}}" class="text-muted">{{trans('s_admin.nav_permissions')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="" class="text-muted">{{trans('s_admin.nav_employee_permission_srttings')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="" class="text-muted">{{trans('s_admin.nav_settings_control_panel')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <form action="{{ route('roles.store') }}" method="POST">
        <div class="row">
            @csrf
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="center">
                                <input type="text" placeholder="{{trans('s_admin.role_name')}}" id="name" name="name" class="form-control" style="width: 600px;" required>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h5 class="m-b-0 text-white">{{trans('admin.nav_permissions')}}</h5>
                    </div>
                    <br>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-from-label" for="banner"></label>
                            <div class="col-md-8">
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.mail')}}</span>
                                @foreach($mail as $permission)
                                <div class="row">
                                    <div class="col-md-10">
                                        @if(app()->getLocale() == 'en')
                                            <label class="col-from-label">{{ $permission->name }}</label>
                                        @elseif(app()->getLocale() == 'ar')
                                            <label class="col-from-label">{{ $permission->name_ar }}</label>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.manage_students')}}</span>
                                @foreach($students as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.nav_teacher_shoan_settings')}}</span>
                                @foreach($teachers as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.nav_manage_electronic_chanel')}}</span>
                                @foreach($episodes as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.nav_method')}}</span>
                                @foreach($subjects as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.nav_reports_and_stat')}}</span>
                                @foreach($reports as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.nav_center_notifications')}}</span>
                                @foreach($sms as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.settings')}}</span>
                                @foreach($settings as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.nav_out_website_settings')}}</span>
                                @foreach($web as $permission)
                                    <div class="row">
                                        <div class="col-md-10">
                                            @if(app()->getLocale() == 'en')
                                                <label class="col-from-label">{{ $permission->name }}</label>
                                            @elseif(app()->getLocale() == 'ar')
                                                <label class="col-from-label">{{ $permission->name_ar }}</label>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
{{--                                <span class="label label-inline label-light-primary font-weight-bold">{{trans('s_admin.permisions')}}</span>--}}
{{--                                @foreach($web_permissions as $permission)--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            @if(app()->getLocale() == 'en')--}}
{{--                                                <label class="col-from-label">{{ $permission->name }}</label>--}}
{{--                                            @elseif(app()->getLocale() == 'ar')--}}
{{--                                                <label class="col-from-label">{{ $permission->name_ar }}</label>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-2">--}}
{{--                                            <div class="switch">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" name="permissions[]" value="{{$permission->name}}"><span class="lever switch-col-indigo"></span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
                           </div>
                        </div>
                        <div class="center">
                            <button type="submit" class="m-t-10 m-b-20 waves-effect waves-dark btn btn-success btn-md btn-rounded">{{trans('admin.public_Save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
