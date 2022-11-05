<div class="row">
    <div class="col-md-3">
        <label class="form-control" >{{$addon->name}}</label>
        <input type="hidden"  name="addon_ids[]" value="{{$addon->id}}" >
    </div>
    <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <input required type="number" min="0" max="999999999999.00" step="any" class="form-control" name="prices[]" placeholder="{{trans('lang.price')}}"
                           >
                </div>
            </div>
    </div>
</div>
<br>
