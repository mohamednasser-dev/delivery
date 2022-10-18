@php($title='الاعدادات')
@extends('admin_temp')
@section('title')
    {{$title}}
@endsection
@section('header')

@endsection
@section('breadcrumb')
    <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-warning font-weight-bold my-1 mr-5">{{$title}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-warning">
                <a href="{{route('home')}}"
                   class="text-muted">الصفحة الرئيسية</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-header card-header-tabs-line">
                    <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab"
                               href="#kt_builder_themes">الاعدادات الاساسية</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content pt-3">
                        <div class="tab-pane active" id="kt_builder_themes">
                            <div class="row">
                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="site_name_ar">أسم الموقع بالعربيه<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="site_name_ar" id="site_name_ar"
                                               value="{{ old('site_name_ar', $data->where('key', 'site_name_ar')->first()->val) }}"
                                               class="form-control {{ $errors->has('site_name_ar') ? 'border-danger' : '' }}"
                                               placeholder="أدخل أسم الموقع بالعربيه"/>
                                    </div>
                                </div>

                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="site_name_en">أسم الموقع بالانجليزيه<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="site_name_en" id="site_name_en" style="direction: ltr;"
                                               value="{{ old('site_name_en', $data->where('key', 'site_name_en')->first()->val) }}"
                                               class="form-control {{ $errors->has('site_name_en') ? 'border-danger' : '' }}"
                                               placeholder="أدخل أسم الموقع بالعربيه"/>
                                    </div>
                                </div>

                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="address_ar">العنوان بالعربيه<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="address_ar" id="address_ar"
                                               value="{{ old('address_ar', $data->where('key', 'address_ar')->first()->val) }}"
                                               class="form-control {{ $errors->has('address_ar') ? 'border-danger' : '' }}"
                                               placeholder="أدخل العنوان بالعربيه"/>
                                    </div>
                                </div>

                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="address_en">العنوان بالانجليزيه<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="address_en" id="address_en" style="direction: ltr;"
                                               value="{{ old('address_en', $data->where('key', 'address_en')->first()->val) }}"
                                               class="form-control {{ $errors->has('address_en') ? 'border-danger' : '' }}"
                                               placeholder="أدخل العنوان بالانجليزيه"/>
                                    </div>
                                </div>

                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="location">رابط العنوان <span
                                                class="text-danger">*</span></label>
                                        <input type="url" name="location" id="location"
                                               value="{{ old('location', $data->where('key', 'location')->first()->val) }}"
                                               class="form-control {{ $errors->has('location') ? 'border-danger' : '' }}"
                                               placeholder="أدخل رابط العنوان"/>
                                    </div>
                                </div>

                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="phone">رقم الجوال <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="phone" id="phone"
                                               value="{{ old('phone', $data->where('key', 'phone')->first()->val) }}"
                                               class="form-control {{ $errors->has('phone') ? 'border-danger' : '' }}"
                                               placeholder="أدخل رقم الجوال"/>
                                    </div>
                                </div>
                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group ">
                                        <label for="email">البريد الالكتروني <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email"
                                               value="{{ old('email', $data->where('key', 'email')->first()->val) }}"
                                               class="form-control {{ $errors->has('email') ? 'border-danger' : '' }}"
                                               placeholder="أدخل البريد الالكتروني"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="">لوجو الموقع<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" id="kt_image_1">
                                            <div
                                                class="image-input-wrapper {{ $errors->has('logo') ? 'border-danger' : '' }}"
                                                style="background-image: url({{$data->where('key', 'logo')->first()->val ?? ''}})"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="اختر صوره">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file"
                                                       value="{{ old('youtube', $data->where('key', 'logo')->first()->val) }}"
                                                       name="logo" accept=".png, .jpg, .jpeg"/>
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">خلفيه صفحه الدخول (600 * 1100 )<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" id="kt_image_2">
                                            <div
                                                class="image-input-wrapper {{ $errors->has('login_pg') ? 'border-danger' : '' }}"
                                                style="background-image: url({{$data->where('key', 'login_pg')->first()->val ?? ''}})"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="اختر صوره">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file"
                                                       value="{{ old('youtube', $data->where('key', 'login_pg')->first()->val) }}"
                                                       name="login_pg"
                                                       accept=".png, .jpg, .jpeg"/>
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">لوجو صفحه الدخول<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" id="kt_image_3">
                                            <div
                                                class="image-input-wrapper {{ $errors->has('logo_login') ? 'border-danger' : '' }}"
                                                style="background-image: url({{$data->where('key', 'logo_login')->first()->val ?? ''}})"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="اختر صوره">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file"
                                                       value="{{ old('youtube', $data->where('key', 'logo_login')->first()->val) }}"
                                                       name="logo_login"
                                                       accept=".png, .jpg, .jpeg"/>
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>

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
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_2');
    </script>
    <script !src="">
        var avatar1 = new KTImageInput('kt_image_3');
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
    <script src="{{url('/')}}/metronic/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
    <script>
        var terms_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#terms_ar'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            terms_ar.init();
        });
    </script>
    <script>
        var terms_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#terms_en'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            terms_en.init();
        });
    </script>
    <script>
        var privacy_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#privacy_ar'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            privacy_ar.init();
        });
    </script>
    <script>
        var privacy_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#privacy_en'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            privacy_en.init();
        });
    </script>
    <script>
        var usage_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#usage_ar'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            usage_ar.init();
        });
    </script>
    <script>
        var usage_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#usage_en'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            usage_en.init();
        });
    </script>
    <script>
        var about_ar = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#about_ar'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            about_ar.init();
        });
    </script>
    <script>
        var about_en = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#about_en'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            about_en.init();
        });
    </script>
@endsection

