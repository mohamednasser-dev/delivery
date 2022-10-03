<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <form action="{{route('change_pass.update.pass')}}" method="post">
        @csrf
        <div class="card card-custom">
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">{{trans('s_admin.change_pass')}}</h3>
                </div>
                <div class="card-toolbar" style="text-align: left">
                    <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save_changes')}}</button>
                    <button type="reset" class="btn btn-secondary">{{trans('s_admin.cancel')}}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{trans('s_admin.curr_pass')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input name="curr_pass" type="password" required
                               class="form-control form-control-lg form-control-solid mb-2"/>
                        <a href="{{route('Forget-password')}}"
                           class="text-sm font-weight-bold">{{trans('s_admin.forget_pass')}}</a>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{trans('s_admin.new_pass')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input name="password" type="password" required
                               class="form-control form-control-lg form-control-solid"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{trans('s_admin.confirm_pass')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input name="password_confirmation" type="password" required
                               class="form-control form-control-lg form-control-solid"/>
                    </div>
                </div>
            </div>
    </form>
    <!--end::Form-->
</div>
</div>
@include('sweetalert::alert')
