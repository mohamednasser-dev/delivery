@can('update-cities')
<span class="switch">
    <label>
        <input type="checkbox" onchange="update_active(this)"
               @if ($active == 1) checked
               @endif name="select" value="{{ $id }}"/>
        <span></span>
    </label>
</span>
@endcan
