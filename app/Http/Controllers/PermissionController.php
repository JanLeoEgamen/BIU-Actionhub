<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',

            new Middleware('permission:view permissions', only: [
                'index',
                'show',
            ]),

            new Middleware('permission:create permissions', only: [
                'create',
                'store',
            ]),

            new Middleware('permission:edit permissions', only: [
                'edit',
                'update',
            ]),

            new Middleware('permission:delete permissions', only: [
                'destroy',
            ]),
        ];
    }

    public function index(): View
    {
        $permissions = Permission::withCount('roles')
            ->orderBy('name')
            ->paginate(20);

        return view('permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name'),
            ],
        ]);

        Permission::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function show(Permission $permission): View
    {
        $permission->load('roles');

        return view('permissions.view', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(
        Request $request,
        Permission $permission
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')
                    ->ignore($permission->id),
            ],
        ]);

        $permission->update([
            'name' => $validated['name'],
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}