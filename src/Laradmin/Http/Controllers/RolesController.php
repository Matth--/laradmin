<?php

namespace MatthC\Laradmin\Http\Controllers;


use App\Http\Controllers\Controller;
use MatthC\Laradmin\Repositories\RoleRepository;
use Symfony\Component\HttpFoundation\Request;
use MatthC\Privileges\Models\Permission;
use MatthC\Privileges\Models\Role;

class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getPaginated(20);

        return view('laradmin::roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('laradmin::roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'description' => 'required',
        ]);

        $role = Role::create([
            'name'  => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        $role->permissions()->sync($request->get('permissions'));

        $this->roleRepository->clearCache();
        return redirect()->route('laradmin.roles.index')->with('Role was created!');
    }

    public function edit($id)
    {
        $role_to_edit = Role::find($id);

        $all_permissions = Permission::all();

        return view('laradmin::roles.edit', compact('role_to_edit', 'all_permissions'));
    }

    public function update($id, Request $request)
    {
        $role = Role::find($id);

        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'description' => 'required',
        ]);

        $role->name = $request->get('name');
        $role->description = $request->get('description');

        $role->save();

        $role->permissions()->sync($request->get('permissions'));
        $this->roleRepository->clearCache();
        return redirect()->route('laradmin.roles.index')->with('success', 'Role was updated!');
    }

    public function delete($id)
    {
        $role = Role::find($id);

        $role->delete();
        $this->roleRepository->clearCache();
        return redirect()->route('laradmin.roles.index')->with('success', 'Role was deleted!');
    }
}