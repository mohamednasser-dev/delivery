@extends('front.layouts.temp')
@section('content')

    <div class="container">
        <div class="sec-title text-center w-100">
            <div class="sec-title-inner d-inline-block">
                <h4 class="mb-0" style="color: green;padding-top: 20px;">@if(session('lang') == 'ar') استرجاع كلمة المرور  @else Forget Password @endif </h4>
            </div>
        </div><!-- Sec Title -->
        <div class="prod-wrap overlap-150 prod-caro w-100 slick-initialized slick-slider">
            <div class="card">
                <div class="card-body" style="background-color: beige;">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" action="{{ route('changePasswordForRest') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">

                                 <div class="col-md-6">
                                        <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        <input id="type" type="hidden" class="form-control @error('email') is-invalid @enderror" name="type" value="{{ Request::get('type') }}" required  autofocus>
                                        <input id="unique_name" type="hidden" class="form-control @error('unique_name') is-invalid @enderror" name="unique_name" value="{{ Request::get('unique_name')  ?? old('unique_name') }}" required  autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{trans('admin.password')}}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{trans('admin.password_confirmation')}}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                    <div class="col-md-12 offset-md-12 text-center">
                                        <button type="submit"  class="thm-btn mini-btn thm-bg ">
                                            @if(session('lang') == 'ar') استرجاع كلمة المرور  @else Forget Password @endif
                                        </button>
                                    </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    resend--}}
    <div id="teacher_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content" style="">
                <div class="modal-header row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('admin.choose_type_epo')}}</h5>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input name="email" type="email">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
