<div class="row" >
    <div class="col-md-3">
        <label class="form-control">{{$attribute->name}}</label>
    </div>
    <div class="col-md-9" id="options_container_{{$attribute->id}}">
        @foreach($options as $key=> $row)
            <div class="row" id="option_row_{{$row->id}}">
                <div class="col-md-26">
                   <a href="javascripte::void($this);" onclick="delete_option({{$row->id}},{{$attribute->id}})"><i style="margin-top: 10px;" class="fa fa-trash"></i></a>
                </div>
                <div class="col-md-4">
                    <input type="hidden" name="attr_options_ids[{{$row->attribute_id}}][]" value="{{$row->id}}">
                    <input type="text" readonly class="form-control form-control-solid" name="option_names[]"
                           value="{{$row->name}}">
                </div>
                <div class="col-md-6">
                    <input type="number" min="0" max="999999999999.00" step="any" class="form-control" required
                           name="option_prices[{{$row->id}}][]" placeholder="{{trans('lang.price')}}">
                </div>
            </div>
            <br>
        @endforeach

    </div>
</div>
<hr>
