@php($title='تعديل الصفحة')
@extends('admin_temp')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Breadcrumb-->
        <h5 class="text-warning font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('pages')}}"
                   class="text-muted">الصفحات</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>

        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('pages.update',$data->id)}}" enctype="multipart/form-data" files="true">
                @csrf
                <div class="card-body row">
                    <div class="form-group  col-6">
                        <label>العنوان بالعربيه<span
                                class="text-danger">*</span></label>
                        <textarea name="title_ar" rows="10" cols="90"
                                  class="form-control">{{$data->title_ar}}</textarea>
                    </div>
                    <div class="form-group  col-6">
                        <label>العنوان بالانجليزيه<span
                                class="text-danger">*</span></label>
                        <textarea name="title_en" rows="10" cols="90"
                                  class="form-control">{{$data->title_en}}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label> صورة الصفحة
                        </label>
                        <div class="col-lg-8">
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper {{ $errors->has('image') ? 'border-danger' : '' }}"
                                     style="background-image: url({{ $data->image}})"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-warning btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="اختر صوره">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" value="{{ $data->image}}" name="image"
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
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_1');
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
@endsection

