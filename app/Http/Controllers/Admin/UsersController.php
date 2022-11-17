<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class usersController extends Controller
{
    public $objectName;
    public $folderView;

    public function __construct(User $model)
    {
//        $this->middleware(['permission:employees']);
        $this->objectName = $model;
        $this->folderView = 'admin.users.';
    }

    public function index()
    {
        $users = $this->objectName::admin()->where('id', '!=', 1)->orderBy('created_at', 'desc')->get();
        return view($this->folderView . 'users', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view($this->folderView . 'create_user', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['type'] = 'admin';
        $user = User::create($data);
        if ($user->save()) {
            $user->roles()->sync([$data['role_id']]);
            $user->save();
            session()->flash('success', trans('admin.addedsuccess'));
            return redirect(url('users'));
        }

    }


    public function edit($id)
    {
        $roles = Role::all();
        $data = $this->objectName::findOrFail($id);
        return view($this->folderView . 'edit', \compact('data', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        if ($data['image']) {
            if (is_file($data['image'])) {
                $img_name = time() . uniqid() . '.' . $data['image']->getClientOriginalExtension();
                $data['image']->move(public_path('/uploads/users_images/'), $img_name);
                $data['image'] = $img_name;
            }
        }
        User::where('id', $id)->update($data);
        $user = User::where('id', $id)->first();
        $user->roles()->sync([$data['role_id']]);
        $user->save();
        session()->flash('success', trans('admin.updatSuccess'));
        return redirect(url('users'));
    }

    public function update_status(Request $request)
    {
        $data['status'] = $request->status;
        User::where('id', $request->id)->update($data);
        return 1;
    }

    public function destroy($id)
    {
        $user = $this->objectName::where('id', $id)->first();
        try {
            $user->delete();
            session()->flash('success', trans('admin.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', trans('admin.emp_no_delete'));
        }
        return back();
    }
}
