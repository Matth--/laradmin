<?php

namespace MatthC\Laradmin\Http\Controllers;

use Validator;
use App\Models\User;
use MatthC\Privileges\Models\Role;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use MatthC\Laradmin\Repositories\UserRepository;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Return a list of users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users =  $this->userRepository->getPaginated(20);
        return view('laradmin::users.index', compact('users'));
    }

    /**
     * Get the create user page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('laradmin::users.create');
    }

    /**
     * Create a user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
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


        $this->userRepository->clearCache();
        return redirect()->route('laradmin.users.index')->with('success', 'User was created!');
    }

    /**
     * Show the edit page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('laradmin::users.edit', compact('user', 'roles'));
    }

    /**
     * Change the user
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('laradmin.users.edit', $user->id)->with('success', 'User was updated');
    }

    /**
     * Update the user Roles
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRoles($id, Request $request)
    {
        $user = User::find($id);
        $roles = $request->get('roles');
        $user->roles()->sync($request->get('roles'));

        return redirect()->route('laradmin.users.edit', $user->id)->with('success', 'Roles were updated!');
    }

    /**
     * Delete a user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();
        }

        return redirect()->route('laradmin.users.index')->with('success', 'User Was deleted!');
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