<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Role";
        $roles = Role::all();
        return view('pages.role.index', ['title' => $title, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Role";
        return view('pages.role.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        Role::create($data);
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $title = "Edit Role";
        return view('pages.role.edit', ['title' => $title, "role" => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role = Role::findOrFail($role->id);
        $data = $request->validate([
            'name' => 'required',
        ]);
        if ($request->premission) {
            $d = $request->premission;
            $data["premission"] = json_encode($d);
        } else {
            $data["premission"] = "[]";
        }
        $role->update($data);
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role = Role::findOrFail($role->id);
        Role::destroy($role->id);
        return redirect(route('role.index'));
    }
}
