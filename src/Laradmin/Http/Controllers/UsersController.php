<?php

namespace MatthC\Laradmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use MatthC\Privileges\Models\Role;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users =  User::paginate(20);
        return view('laradmin::users.index', compact('users'));
    }

    public function getCreate()
    {
        return view('laradmin::users.create');
    }

    public function postCreate(Request $request)
    {
        $data = $request->all();

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $role = Role::where('name', config('laradmin.register_user_role'))->first();

        if($role) {
            $user->roles()->attach($role->id);
        }

        return redirect()->route('laradmin.users.index');
    }

    public function getEdit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('laradmin::users.edit', compact('user', 'roles'));
    }

    public function postEdit($id, Request $request)
    {
        $user = User::find($id);
        if($request->get('email') != $user->email) {
            $validated = $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|unique:users'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:255',
            ]);
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $user->save();

        return redirect()->route('laradmin.users.edit', $user->id)->with('message', 'User was updated');
    }

    public function updateRoles($id, Request $request)
    {
        $user = User::find($id);
        $user->roles()->sync($request->get('roles'));

        return redirect()->route('laradmin.users.edit', $user->id)->with('message', 'Roles were updated!');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();
        }

        return redirect()->route('laradmin.users.index')->with('message', 'User Was deleted!');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
}