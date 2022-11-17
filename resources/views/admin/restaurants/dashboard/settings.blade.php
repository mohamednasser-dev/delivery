{{ Form::open( ['route' => ['restaurant_settings.update'],'method'=>'post', 'files'=>'true'] ) }}
<input type="hidden" name="id" value="{{$data->id}}" required>
<div class="card-body">
<!--begin::Form-->
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <h3 class="font-size-h6 mb-5">{{trans('lang.basic_settings')}}</h3>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">{{trans('lang.active_restaurant')}}</label>
        <div class="col-3">
            <span class="switch switch-lg switch-icon">
                <label>
                    <input type="checkbox" @if($data->is_active) checked="checked" @endif
                    name="is_active">
                    <span></span>
                </label>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">{{trans('lang.commission_needed')}} ( % )</label>
        <div class="col-lg-6 col-xl-3">
            <input class="form-control form-control-lg" type="number" step="any" min="0" max="100"
                   name="commission"
                   value="{{$data->commission}}"/>
        </div>
        <label class="col-3 col-form-label">{{trans('lang.min_order_price')}} ( {{currency()}} )</label>
        <div class="col-lg-6 col-xl-3">
            <input class="form-control form-control-lg" type="number" step="any" min="0" max="100"
                   name="min_order_price"
                   value="{{$data->min_order_price}}"/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">{{trans('lang.tax')}} ( % )</label>
        <div class="col-lg-6 col-xl-3">
            <input class="form-control form-control-lg" type="number" step="any" min="0" max="100"
                   name="tax"
                   value="{{$data->tax}}"/>
        </div>
    </div>
    <div class="separator separator-dashed my-10"></div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <h3 class="font-size-h6 mb-5">{{trans('lang.delivery')}}</h3>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">{{trans('lang.free_delivery')}}</label>
        <div class="col-3">
            <span class="switch switch-lg switch-icon">
                <label>
                    <input type="checkbox" @if($data->free_delivery) checked="checked" @endif
                    name="free_delivery">
                    <span></span>
                </label>
            </span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">{{trans('lang.min_shipping_charge')}} ( {{currency()}} )</label>
        <div class="col-lg-6 col-xl-3">
            <input class="form-control form-control-lg" type="number" step="any" min="0" max="100"
                   name="min_shipping_charge"
                   value="{{$data->min_shipping_charge}}"/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">{{trans('lang.min_delivery_time')}}</label>
        <div class="col-lg-6 col-xl-3">
            <input class="form-control form-control-lg" type="number" min="0" max="100"
                   name="min_delivery_time"
                   value="{{$data->min_delivery_time}}"/>
        </div>
        <label class="col-3 col-form-label">{{trans('lang.max_delivery_time')}}</label>
        <div class="col-lg-6 col-xl-3">
            <input class="form-control form-control-lg" type="number" min="0" max="100"
                   name="max_delivery_time"
                   value="{{$data->max_delivery_time}}"/>
        </div>
    </div>
</div>
{{--<div class="separator separator-dashed my-10"></div>--}}
<!--begin::Heading-->



<div class="d-flex flex-center">
    <button type="submit" class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('lang.save')}}
    </button>
</div>
{{ Form::close() }}
@push('scripts')

@endpush
