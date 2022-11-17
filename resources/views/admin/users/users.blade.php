@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.view_users')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
     <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
{{--                    @can('add')--}}
                    <a href="{{url('users/create')}} " class="btn btn-success font-weight-bolder font-size-sm">
                        <span class="svg-icon svg-icon-md svg-icon-white">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        {{trans('admin.add_new_user')}}
                    </a>
{{--                        @endcan--}}
                </div>
                <div class="card-body">
                   <!-- Start home table -->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th title="Field #1">#</th>
                                <th class="text-lg-center">{{trans('admin.image')}}</th>
                                <th class="text-lg-center">{{trans('admin.name')}}</th>
                                <th class="text-lg-center">{{trans('admin.phone')}}</th>
                                <th class="text-lg-center">{{trans('admin.email')}}</th>
                                <th class="text-lg-center">{{trans('s_admin.nav_job_name')}}</th>
                                <th class="text-lg-center">{{trans('admin.active')}}</th>
                                <th class="text-lg-center">{{trans('admin.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td class="center">
                                    <img class="img-thumbnail" src="{{$user->image}}"
                                         style="height: 75px; width: 75px;">
                                </td>
                                <td class="text-lg-center">{{$user->name}}</td>
                                <td class="text-lg-center">{{$user->phone}}</td>
                                <td class="text-lg-center">{{$user->email}}</td>
                                <td class="text-lg-center">{{$user->Role->name}}</td>
                                <td class="text-lg-center">
                                    <div class="switch">
                                        <label>
                                            <input onchange="update_active(this)" value="{{ $user->id }}" type="checkbox" <?php if($user->status == 'active') echo "checked";?> >
                                            <span class="lever switch-col-indigo"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-lg-center">
                                     <a  class="btn btn-icon btn-primary btn-circle btn-sm mr-2" href=" {{url('users/'.$user->id.'/edit')}}">
                                        <i class="icon-nm fas fa-pencil-alt"></i>
                                    </a>

                                    <form method="get" id='delete-form-{{ $user->id }}'
                                          action="{{url('users/'.$user->id.'/delete')}}"
                                          style='display: none;'>
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                    </form>
                                    <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                        {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                        }else {
                                            event.preventDefault();
                                        }"
                                        class='btn btn-icon btn-danger btn-circle btn-sm mr-2' href=" ">
                                        <i class="fa fa-trash" aria-hidden='true'></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    {{$users->links()}}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      function update_active(el){
            if(el.checked){
                var status = 'active';
            }
            else{
                var status = 'unactive';
            }
            $.post('{{ route('users.actived') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success("{{trans('admin.statuschanged')}}");
                }
                else{
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
  </script>
@endsection
