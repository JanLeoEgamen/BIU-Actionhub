<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',

            new Middleware('permission:view roles', only: [
                'index',
                'show',
            ]),

            new Middleware('permission:create roles', only: [
                'create',
                'store',
            ]),

            new Middleware('permission:edit roles', only: [
                'edit',
                'update',
            ]),

            new Middleware('permission:delete roles', only: [
                'destroy',
            ]),
        ];
    }

    public function index(): View
    {
        $roles = Role::with('permissions')
            ->withCount('users')
            ->latest()
            ->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create-role', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name'),
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

            'permissions.*' => [
                'exists:permissions,id',
            ],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn(
                'id',
                $validated['permissions']
            )->get();

            $role->syncPermissions($permissions);
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role): View
    {
        $role->load('permissions');

        $users = $role->users()
            ->latest()
            ->paginate(10);

        return view('roles.view-role', compact('role', 'users'));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('name')->get();

        $role->load('permissions');

        return view('roles.edit-role', compact(
            'role',
            'permissions'
        ));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

            'permissions.*' => [
                'exists:permissions,id',
            ],
        ]);

        $role->update([
            'name' => $validated['name'],
        ]);

        $permissions = [];

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn(
                'id',
                $validated['permissions']
            )->get();
        }

        $role->syncPermissions($permissions);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->name === 'Super Admin') {
            return redirect()
                ->route('roles.index')
                ->with('error', 'The Super Admin role cannot be deleted.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}