<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users_read')->only('index');
        $this->middleware('permission:users_update')->only('edit');
        $this->middleware('permission:users_create')->only('create');
        $this->middleware('permission:users_delete')->only('destroy');
    }

    public function index(Request $request)
    {

        $users = User::whereRoleIs('admin')->when($request->search, function ($query) use ($request) {
            return $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);


        return view('dashboard.users.index', compact('users'));
    }


    public
    function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'image' => 'image',
            'password' => 'required|confirmed',
            'phone' => 'required',
            'permissions' => 'required|min:1',

        ]);
        $data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $data['password'] = bcrypt($request->password);
        if ($request->image) {
            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
        }

        $user = User::create($data);
        $user->attachRole('admin');
        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }
        Alert::toast('You\'ve Successfully created', 'success');

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
            'phone' => 'required',
            'image' => 'image',
            'permissions' => 'required|min:1',
            'password' => 'confirmed',
        ]);
        if ($request->password) {
            $data = $request->except(['permissions', 'password', 'password_confirmation', 'image']);
            $data['password'] = bcrypt($request->password);
            $user->update($data);
        } else {
            $data = $request->except(['permissions', 'password', 'password_confirmation', 'image']);
            $user->update($data);
        }


        if ($request->image) {
            if ($user->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/users/' . $user->image);
            }
            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
            $user->update($data);
        } else {
            $data['image'] = $user->image;
            $user->update($data);
        }


        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }
        Alert::toast('You\'ve Successfully updated', 'success');

        return redirect()->route('users.index');
    }


    public
    function destroy(User $user)
    {
        if ($user->image != 'default.jpg') {
            Storage::disk('public_uploads')->delete('/users/' . $user->image);
        }

        $user->delete();
        Alert::toast('You\'ve Successfully deleted', 'success');

        return redirect()->route('users.index');
    }
}
