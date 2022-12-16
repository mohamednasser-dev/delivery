<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>{{trans('lang.data')}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group  col-12">
                        <label>كود الكوبون<span
                                class="text-danger">*</span></label>
                        <input required name="code" placeholder="كود الكوبون"
                               value="{{ old('code', $data->code ?? '') }}"
                               class="form-control  {{ $errors->has('code') ? 'border-danger' : '' }}" type="text"
                               maxlength="255"/>
                    </div>
                    <div class="form-group  col-6">
                        <label>من تاريخ<span
                                class="text-danger">*</span></label>
                        <input required name="from_date" value="{{ old('from_date', $data->from_date ?? '') }}"
                               class="form-control  {{ $errors->has('from_date') ? 'border-danger' : '' }}" type="date"
                        />
                    </div>
                    <div class="form-group  col-6">
                        <label>الى تاريخ<span
                                class="text-danger">*</span></label>
                        <input required name="to_date" value="{{ old('to_date', $data->to_date ?? '') }}"
                               class="form-control  {{ $errors->has('to_date') ? 'border-danger' : '' }}" type="date"
                        />
                    </div>
{{--                    <div class="form-group  col-6">--}}
{{--                        <label>نوع الخصم<span--}}
{{--                                class="text-danger">*</span></label>--}}
{{--                            <select name="type" required id="cmb_type"--}}
{{--                                    class="form-control custom-select col-12">--}}
{{--                                <option--}}
{{--                                    value="percent" @if( request()->segment(2) == 'edit' ) {{ $data->target_type ==  "percent" ? 'selected' : '' }} @endif >{{trans('lang.by_percent')}}</option>--}}
{{--                                <option--}}
{{--                                    value="amount" @if( request()->segment(2) == 'edit' ) {{ $data->target_type == "amount" ? 'selected' : '' }} @endif >{{trans('lang.by_amount')}}</option>--}}
{{--                            </select>--}}
{{--                    </div>--}}
                    <div class="form-group  col-6">
                        <label>مقدار الخصم <span
                                class="text-danger">*</span></label>
                        <input required name="amount" min="0" max="100" value="{{ old('amount', $data->amount ?? '') }}"
                               class="form-control  {{ $errors->has('amount') ? 'border-danger' : '' }}" type="number"
                               step="any"
                        />
                    </div>
                    <div class="form-group  col-6">
                        <label>عدد استخدامات كوبون الخصم <span
                                class="text-danger">*</span></label>
                        <input required name="usage_count" min="0" max="999999999" value="{{ old('usage_count', $data->usage_count ?? '') }}"
                               class="form-control  {{ $errors->has('usage_count') ? 'border-danger' : '' }}" type="number"
                        />
                    </div>
                    <div class="form-group  col-6">
                        <label>اقل قيمة للطلب لاستخدام كوبون الخصم<span
                                class="text-danger">*</span></label>
                        <input required name="min_order_price" min="0" value="{{ old('min_order_price', $data->min_order_price ?? '') }}"
                               class="form-control  {{ $errors->has('min_order_price') ? 'border-danger' : '' }}" type="number"
                               step="any"
                        />
                    </div>
                </div>
                <div class="row" style="justify-content: center;">

                    {{ Form::submit( trans('lang.save') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}

                </div>
            </div>
        </div>
    </div>
</div>
