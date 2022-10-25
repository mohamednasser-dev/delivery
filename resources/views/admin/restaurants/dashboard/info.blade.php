<form class="form">
    <!--begin::Heading-->
    <div class="row">
        <div class="col-lg-9 col-xl-6 offset-xl-3">
            <h3 class="font-size-h6 mb-5">Student Info:</h3>
        </div>
    </div>
    <!--end::Heading-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Photo</label>
        <div class="col-lg-9 col-xl-9">
            <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar" style="background-image: url(assets/media/users/blank.png)">
                <div class="image-input-wrapper" style="background-image: url(assets/media/svg/avatars/007-boy-2.svg)"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
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
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Name</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" value="Nick" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Nickname</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" value="Bold" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Organization</label>
        <div class="col-lg-9 col-xl-6">
            <input class="form-control form-control-lg form-control-solid" type="text" value="Loop Inc." />
            <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
        </div>
    </div>
    <div class="separator separator-dashed my-10"></div>
    <!--begin::Heading-->
    <div class="row">
        <div class="col-lg-9 col-xl-6 offset-xl-3">
            <h3 class="font-size-h6 mb-5">Contact Info:</h3>
        </div>
    </div>
    <!--end::Heading-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Phone</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" value="+35278953712" placeholder="Phone" />
            </div>
            <span class="form-text text-muted">We'll never share your email with anyone else.</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Email Address</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-at"></i>
																			</span>
                </div>
                <input type="text" class="form-control form-control-lg form-control-solid" value="nick.bold@loop.com" placeholder="Email" />
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Site</label>
        <div class="col-lg-9 col-xl-6">
            <div class="input-group input-group-lg input-group-solid">
                <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Username" value="loop" />
                <div class="input-group-append">
                    <span class="input-group-text">.com</span>
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-dashed my-10"></div>
    <!--begin::Heading-->
    <div class="row">
        <div class="col-lg-9 col-xl-6 offset-xl-3">
            <h3 class="font-size-h6 mb-5">Contact Info:</h3>
        </div>
    </div>
    <!--end::Heading-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Email Notification</label>
        <div class="col-lg-9 col-xl-6">
																	<span class="switch">
																		<label>
																			<input type="checkbox" checked="checked" name="email_notification_1" />
																			<span></span>
																		</label>
																	</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 text-right col-form-label">Send Copy</label>
        <div class="col-lg-9 col-xl-6">
																	<span class="switch">
																		<label>
																			<input type="checkbox" name="email_notification_2" />
																			<span></span>
																		</label>
																	</span>
        </div>
    </div>
</form>
