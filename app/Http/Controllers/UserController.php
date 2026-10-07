<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',

            new Middleware('permission:view users', only: [
                'index',
                'show',
            ]),

            new Middleware('permission:create users', only: [
                'create',
                'store',
            ]),

            new Middleware('permission:edit users', only: [
                'edit',
                'update',
            ]),

            new Middleware('permission:delete users', only: [
                'destroy',
            ]),
        ];
    }

    public function index(): View
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::orderBy('name')->get();

        return view('users.create-users', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'roles' => [
                'nullable',
                'array',
            ],

            'roles.*' => [
                'exists:roles,id',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if (!empty($validated['roles'])) {
            $roles = Role::whereIn('id', $validated['roles'])
                ->pluck('name')
                ->toArray();

            $user->syncRoles($roles);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user): View
    {
        $user->load('roles', 'permissions');

        return view('users.view-users', compact('user'));
    }

    public function edit(User $user): View
    {
        $roles = Role::orderBy('name')->get();

        $user->load('roles');

        return view('users.edit-users', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:8',
            ],

            'roles' => [
                'nullable',
                'array',
            ],

            'roles.*' => [
                'exists:roles,id',
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $roles = [];

        if (!empty($validated['roles'])) {
            $roles = Role::whereIn('id', $validated['roles'])
                ->pluck('name')
                ->toArray();
        }

        $user->syncRoles($roles);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}