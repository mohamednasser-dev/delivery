<div class="card-body row">
    <div class="form-group  col-6">
        <label>الرابط<span
                class="text-danger">*</span></label>
        <input required name="link" value="{{ old('link', $data->link ?? '') }}" class="form-control  {{ $errors->has('link') ? 'border-danger' : '' }}" type="text"
               maxlength="255" />
    </div>
    <div class="form-group col-md-6">
        <label>الصورة</label>
        <div class="col-lg-8">
            <div class="image-input image-input-outline" id="kt_image_1">
                <div class="image-input-wrapper {{ $errors->has('image') ? 'border-danger' : '' }}"
                     style="background-image: url({{ old('image', $data->image ?? 'default-image.png') }})"></div>
                <label
                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-warning btn-shadow"
                    data-action="change" data-toggle="tooltip" title=""
                    data-original-title="اختر صوره">
                    <i class="fa fa-pen icon-sm text-muted"></i>
                    <input type="file" value="{{ old('image', $data->image ?? '') }}" name="image"
                           accept=".png, .jpg, .jpeg"/>
                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-warning btn-shadow"
                      data-action="cancel" data-toggle="tooltip" title="حذف الصورة">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-left">
    <button type="Submit" id="submit" class="btn btn-success btn-default ">حفظ</button>
    <a href="{{ URL::previous() }}" class="btn btn-secondary">الغاء</a>
</div>
