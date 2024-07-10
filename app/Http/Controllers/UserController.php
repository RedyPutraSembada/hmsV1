<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    public function index()
    {
        $title = "Users";
        $users = User::with('Role')->get();
        return view('pages.users.index', ["title" => $title, "users" => $users]);
    }

    public function create()
    {
        $title = "Create User";
        $roles = Role::all();
        return view('pages.users.create', ['title' => $title, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:guests,email',
            'password' => 'required|min:5|max:120',
            'role_id' => 'required'
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = "Edit User";
        $roles = Role::all();
        return view('pages.users.edit', ['title' => $title, 'roles' => $roles, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Role $role)
    {
        $user = User::findOrFail($user->id);
        $validateData = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:guests,email',
            'password' => 'required|min:5|max:120',
            'role_id' => 'required|exists:roles,id' 
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        $user->update($validateData);
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);

        // Check if role_id is 1
        if ($user->role_id == 1) {
            abort(401);
        }

        // Empty the role_id
        $user->role_id = null; // or any other appropriate default value
        $user->save();

        // Delete the user
        $user->delete();

        return redirect(route('users.index'));
    }


}
