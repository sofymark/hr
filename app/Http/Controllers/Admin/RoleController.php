<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\BulkActionsTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    use BulkActionsTrait;

    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();
        $this->middleware('admin');
        $route = Route::currentRouteName();
        $this->middleware('permission:'.$route);
    }

    /**
     * List of roles
     */
    public function index()
    {
        $roles = Role::filtered()->searched()->sorted('name', 'asc')->paginate(20);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Create role
     */
    public function create(){
        $permissions = Permission::with('roles')->orderBy('group','asc')->get();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Save a role
     */
    public function store(RoleRequest $request){
        $auth = Auth::user();

        $role = Role::create($request->all());

        $this->syncPermissions($role, $request->input('permissions'));

        $request->session()->flash('success', 'Role '.$role->name.' has been created!');
        return redirect()->action('Admin\RoleController@index');
    }

    /**
     * Show a role
     */
    public function show($id)
    {
        $role = Role::filtered()->findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.show', compact('role', 'permissions'));
    }

    /**
     * Edit a role
     */
    public function edit($id)
    {
        $permissions = Permission::with('roles')->orderBy('group','asc')->get();
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update a role
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::filtered()->findOrFail($id);

        $perms = array();
        if (!empty($request->input('permissions'))){
            $perms = $request->input('permissions');
        }

        $role->update($request->all());
        $this->syncPermissions($role, $perms);

        $request->session()->flash('success', 'Role '.$role->name.' was successfully updated!');
        return redirect()->action('Admin\RoleController@index');
    }

    /**
     * Delete a role
     */
    public function destroy($id)
    {
        $role = Role::filtered()->findOrFail($id);
        $role->delete();

        return redirect()->action('Admin\RoleController@index');
    }

    /**
     * Sync permissions of a role
     */
    public function syncPermissions(Role $role, array $permissions){
        $role->permissions()->sync($permissions);
    }

    /**
     * Delete, Activate or Deactivate Bulk Action
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulk(Request $request)
    {
        $this->bulkAction($request, new Role());

        return redirect()->action('Admin\RoleController@index');
    }

    /**
     * Role Search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        Role::search();
        return redirect()->action('Admin\RoleController@index');
    }

}
