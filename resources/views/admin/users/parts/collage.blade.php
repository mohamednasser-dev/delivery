
    @if(app()->getLocale() =='ar')
        <option value="">أختر المجمع</option>
        @forelse($data as $row)
            <option value="{{$row->id}}">{{$row->name_ar}}</option>
        @empty
            <option disabled selected=""> لا يوجد مجمعات </option>
        @endforelse
    @else
        <option value="">Choose the complex</option>
        @forelse($data as $row)
            <option value="{{$row->id}}">{{$row->name_en}}</option>
        @empty
            <option disabled selected=""> no complex found</option>
        @endforelse
    @endif
