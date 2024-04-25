<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManagementController extends AdminController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(config('admin.perPage'));

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        $permission = $permission->groupBy('guard_name');

        return view('admin.roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role-management.index')
                        ->with(['status' => 1, 'msg' => __('admin.Role created successfully')]);
    }

    public function show($id)
    {
        return redirect()->route('role-management.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        $permission = Permission::get();
        $permission = $permission->groupBy('guard_name');
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($id),
            ],
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role-management.index')
                        ->with(['status' => 1, 'msg' => __('admin.Role updated successfully')]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (auth()->user()->roles->find($id)) {
            $notification = [
                'msg' => 'You have no permission for delete this role',
                'status' => 0,
            ];

            return redirect()->route('role-management.index')
                            ->with($notification);
        }
        if ($role->name == 'Super-Admin') {
            $notification = [
                'msg' => 'You have no permission for delete Super-Admin role',
                'status' => 0,
            ];

            return redirect()->route('role-management.index')
                            ->with($notification);
        }
        $role->delete();

        $notification = [
            'msg' => 'The role deleted successfully',
            'status' => 1,
        ];

        return redirect()->route('role-management.index')
                        ->with($notification);
    }
}
