<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Role;
use App\Traits\BulkActionsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{

    use BulkActionsTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
        $route = Route::currentRouteName();
        $this->middleware('permission:'.$route, ['except' => ['dashboard', 'reset', 'resetPassword','myprofile']]);
        $this->defaultLocale = 'en';
    }

    /**
     * List of users
     */
    public function index()
    {
        $users = User::filtered()->searched()->sorted('username', 'asc')->paginate(25);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Create a user
     */
    public function create(){
        $roles = Role::filtered()->lists('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    /**r
     * Save a user
     */
    public function store(UserRequest $request){
        $this->createUser($request);
        $request->session()->flash('success', 'User '.$request->input('firstname').' '.$request->input('lastname').' has been created!');
        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Show a User
     */
    public function show($id)
    {
        $user = User::with(['avatars'])->findOrFail($id);
        $roles = $user->filtered()->roles()->get();
        return view('admin.users.show', compact(['roles', 'user']));
    }

    /**
     * Edit a User
     */
    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Edit my profile
     */
    public function myprofile(){
        $user = Auth::user();
        $roles = Role::lists('name', 'id');
        return view('admin.users.edit', compact('user', 'roles'));
    }


    /**
     * Update a User
     */
    public function update(UserRequest $request, $id){
        $user = User::findOrFail($id);

        if(!empty($request->input('password'))){
            $req = $request->all();
            $req['password'] = bcrypt($request->input('password'));
        }else{
            $req = $request->except('password');
        }

        if (empty($request->input('active'))){
            $req['active'] = 0;
        }

        $req['role_list'] = $request->input('role_list');

        $user->update($req);

        if(!empty($request['image_id'])){
            $this->syncAvatars($user, array($request['image_id']));
        }
        $this->syncRoles($user, $req['role_list']);

        $request->session()->flash('success', 'User has been updated!');
        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Delete a User
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Sync user roles
     */
    public function syncRoles(User $user, array $roles){
        $user->roles()->sync($roles);
    }

    /**
     * Store user
     */
    public function createUser($request)
    {
        $auth = Auth::user();
        $req = $request->all();
        $req['auto_login'] = str_random(30);
        $req['password'] = bcrypt($request->input('password'));
        $req['role_list'] = $request->input('role_list');

        $user = User::create($req);
        $this->syncRoles($user, $req['role_list']);

        return $user;
    }

    /**
     * User dashboard
     */
    public function dashboard()
    {
        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Delete, Activate or Deactivate Bulk Action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulk()
    {
        $this->bulkAction(new User);

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * User Search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        User::search();
        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Activate / Deactivate row
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param User $user
     */
    public function status($id)
    {
        $user = User::findOrFail($id);
        $user->update(array('active' => $user->active ? 0 : 1));

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Reset password
     */
    public function reset()
    {
        return view('admin.profile.reset');
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6'
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $request->session()->flash('success', 'Your password has been changed!');
        return redirect()->back();
    }

    /**
     * Sync user avatars
     */
    public function syncAvatars(User $user, array $avatars){
        $user->avatars()->sync($avatars);
        $user->avatars()->update(['enabled'=>1]);
    }

}
