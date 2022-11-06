@foreach($options as $row)
    <tr>
        <td class="center">
            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->name_ar}}</span>
        </td>
        <td class="center">
            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->name_en}}</span>
        </td>
        <td class="center">
            <a class="btn btn-icon btn-primary btn-circle btn-sm mr-2" id="edit_option"
               data-editid="{{$row->id}}" data-name_ar="{{$row->name_ar}}"
               data-name_en="{{$row->name_en}}" data-dismiss="modal" data-toggle="modal" data-target="#edit_options_model" data-mo>
                <i class="icon-nm fas fa-pencil-alt"></i>
            </a>
            <a onclick="return confirm('{{trans('lang.are_y_sure_delete')}}')"
               href="{{route('options.delete',$row->id)}}"
               class='btn btn-icon btn-danger btn-circle btn-sm mr-2'
               title="{{trans('lang.delete')}}"><i
                    class="icon-nm fas fa-trash"
                    aria-hidden='true'></i></a>
        </td>
    </tr>
@endforeach
