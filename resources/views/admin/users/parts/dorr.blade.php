

    @if(app()->getLocale() =='ar')
        <option value="">أختر الدار</option>
        @forelse($data as $row)
            <option value="{{$row->id}}">{{$row->name_ar}}</option>
        @empty
            <option disabled selected=""> لا يوجد دور </option>
        @endforelse
    @else
        <option value="">Choose dorr</option>
        @forelse($data as $row)
            <option value="{{$row->id}}">{{$row->name_en}}</option>
        @empty
            <option disabled selected=""> no dorr</option>
        @endforelse
    @endif
