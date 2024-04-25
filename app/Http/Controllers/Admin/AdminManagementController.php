<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Admin;
use DB;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminManagementController extends AdminController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $admins = Admin::orderBy('id', 'DESC')->paginate(config('admin.perPage'));

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('Super-Admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::pluck('name', 'name')->except(['name', 'Super-Admin']);
        }

        // dd($roles);

        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $admin = Admin::create($input);
        $admin->assignRole($request->input('roles'));

        $notification = [
            'msg' => 'User created successfully',
            'status' => 1,
        ];

        return redirect()->route('admin-management.index')
                        ->with($notification);
    }

    public function show($id)
    {
        return redirect()->route('admin-management.index');
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        if ($admin->hasRole('Super-Admin')) {
            $notification = [
                'msg' => 'You have no permission for edit this user',
                'status' => 'error',
            ];

            return redirect()->route('admin-management.index')
                            ->with($notification);
        }
        if (auth()->user()->hasRole('Super-Admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } else {
            $roles = Role::pluck('name', 'name')->except(['name', 'Super-Admin']);
        }
        $adminRole = $admin->roles->pluck('name', 'name')->all();

        return view('admin.admins.edit', compact('admin', 'roles', 'adminRole'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'roles' => 'required',
        ]);

        $input = $request->all();
        $admin = Admin::find($id);
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $admin->assignRole($request->input('roles'));

        $notification = [
            'msg' => 'Account updated successfully',
            'status' => 1,
        ];

        return redirect()->route('admin-management.index')
                        ->with($notification);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (auth()->id() == $id) {
            $notification = [
                'msg' => 'You cannot delete yourself',
                'status' => 0,
            ];

            return redirect()->route('admin-management.index')
                            ->with($notification);
        }
        if ($admin->hasRole('Super-Admin')) {
            $notification = [
                'msg' => 'You have no permission for delete this account',
                'status' => 0,
            ];

            return redirect()->route('admin-management.index')
                            ->with($notification);
        }
        $admin->delete();
        $notification = [
            'msg' => 'Account deleted successfully',
            'status' => 1,
        ];

        return redirect()->route('admin-management.index')
                        ->with($notification);
    }
}
