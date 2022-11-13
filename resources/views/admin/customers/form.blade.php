<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>{{trans('lang.data')}}</h3>
            </div>
            <div class="card-body">
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('lang.name_ar')}}</label>
                    <div class="col-md-10">
                        {{ Form::text('name_ar',old('name_ar',$data->name_ar ?? null),["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="form-group m-t-40 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">{{trans('lang.name_en')}}</label>
                    <div class="col-md-10">
                        {{ Form::text('name_en',old('name_en',$data->name_en ?? null),["class"=>"form-control" ,"required"]) }}
                    </div>
                </div>
                <div class="center">
                    {{ Form::submit( trans('lang.save') ,['class'=>'btn btn-info','style'=>'margin:10px']) }}
                </div>
            </div>
        </div>
    </div>
</div>
