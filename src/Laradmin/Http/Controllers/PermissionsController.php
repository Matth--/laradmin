<?php

namespace MatthC\Laradmin\Http\Controllers;

use MatthC\Privileges\Models\Permission;
use Validator;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class PermissionsController extends Controller
{
    /**
     * Return a list of users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::paginate(20);
        return view('laradmin::permissions.index', compact('permissions'));
    }

    /**
     * Get the create user page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('laradmin::permissions.create');
    }

    /**
     * Create a user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|min:3|max:255',
            'description' => 'required|max:255',
        ]);

        Permission::create([
            'name'  => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('laradmin.permissions.index')->with('success', 'Permission was added!');
    }

    /**
     * Show the edit page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('laradmin::permissions.edit', compact('permission'));
    }

    /**
     * Update the permission
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $permission = Permission::find($id);
        $this->validate($request, [
            'name'  => 'required|min:3|max:255',
            'description' => 'required|max:255,'
        ]);

        $permission->name = $request->get('name');
        $permission->description = $request->get('description');

        $permission->save();

        return redirect()->route('laradmin.permissions.index')->with('success', 'Permission was updated!');
    }

    /**
     * Delete a permission
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $permission = Permission::find($id);
        if($permission) {
            $permission->delete();
        }

        return redirect()->route('laradmin.permissions.index')->with('success', 'Permission Was deleted!');
    }
}