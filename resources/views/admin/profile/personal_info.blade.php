<!--begin::Content-->
<div class="flex-row-fluid ml-lg-8">
    <form class="form" action="{{route('admin.store.profile')}}" method="post" files="true" enctype="multipart/form-data">
        @csrf
        <div class="card card-custom card-stretch">
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">{{trans('s_admin.personal_info')}}</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{trans('s_admin.update_personal_info')}}</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.save_changes')}}</button>
                    <button type="reset" class="btn btn-secondary">{{trans('s_admin.cancel')}}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('s_admin.personal_image')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(uploads/users_images/blank.png)">
                            <div class="image-input-wrapper" style="background-image: url({{$data->image}})"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.full_name')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" name="name" value="{{$data->name}}" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mt-10 mb-6">{{trans('s_admin.contact_data')}}</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.phone')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-phone"></i>
                                </span>
                            </div>
                            <input type="text" name="phone" value="{{$data->phone}}" class="form-control form-control-lg form-control-solid" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{trans('admin.email')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                            </div>
                            <input type="text" readonly name="email" value="{{$data->email}}" class="form-control form-control-lg form-control-solid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!--end::Content-->
