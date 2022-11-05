<div class="row">
    <div class="col-md-3">
        <label class="form-control">{{$attribute->name}}</label>
    </div>
    <div class="col-md-9">
        @foreach($options as $row)
            <div class="row">
                <div class="col-md-6">
{{--                    <input type="hidden" name="attr_options[]" value="{{$row->id}}">--}}
                    <input type="text" readonly class="form-control form-control-solid" name="option_names[]"
                           value="{{$row->name}}">
                </div>
                <div class="col-md-6">
                    <input type="number" min="0" max="999999999999.00" step="any" class="form-control" required
                           name="option_prices[]" placeholder="{{trans('lang.price')}}">
                </div>
            </div>
            <br>
        @endforeach

    </div>
</div>
