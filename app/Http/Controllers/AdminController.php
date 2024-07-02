<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::select('id', 'name', 'email')->with('roles')->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.manageUsers', compact('users', 'roles', 'permissions'));
    }

    public function editUserPermissions($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.editUserPermissions', compact('user', 'permissions'));
    }

    public function updateUserPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $permissions = $request->permissions ?? [];

        foreach ($user->roles as $role) {
            $role->permissions()->sync($permissions);
        }

        return redirect()->route('usertool')->with('success', 'Permissions updated successfully.');
    }

    public function updateUserRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('usertool')->with('success', 'Roles updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('usertool')->with('success', 'User deleted successfully.');
    }
}
