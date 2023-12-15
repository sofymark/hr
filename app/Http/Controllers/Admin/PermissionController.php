<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Traits\BulkActionsTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
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
     * List of permissions
     */
    public function index()
    {
        $permissions = Permission::searched()->sorted('group','asc')->paginate(25);
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Create permission
     */
    public function create(){
        return view('admin.permissions.create');
    }

    /**
     * Save a permission
     */
    public function store(PermissionRequest $request){
        $permission= new Permission($request->all());
        $permission->save();

        $request->session()->flash('success', 'Permission '.$permission->name.' has been created!');
        return redirect()->action('Admin\PermissionController@index');
    }

    /**
     * Show a permission
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Edit a permission
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update a permission
     */
    public function update(PermissionRequest $request, $id){
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        $request->session()->flash('success', 'Permission '.$permission->name.' was successfully updated!');
        return redirect()->action('Admin\PermissionController@index');
    }

    /**
     * Delete a permission
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->action('Admin\PermissionController@index');
    }

    /**
     * Delete, Activate or Deactivate Bulk Action
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulk(Request $request)
    {
        $this->bulkAction($request, new Permission());

        return redirect()->action('Admin\PermissionController@index');
    }

    /**
     * Permission Search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        Permission::search();
        return redirect()->action('Admin\PermissionController@index');
    }
}
