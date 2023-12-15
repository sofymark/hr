<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use SearchableTrait, SortableTrait;

    /**
     * Fillable fields
     */
    protected $fillable = [
        'name', 'machine', 'description'
    ];

    protected $sortable = [
        'columns' => [
            'name' => ['label' => 'Name', 'toggle' => 1],
            'machine' => ['label' => 'Slug', 'hide' => 1],
        ]
    ];

    protected $searchable = [
        'columns' => [
            'name' => ['type' => 'string', 'element' => 'text', 'toggle' => 1],
            'machine' => ['type' => 'string', 'element' => 'text', 'hide' => 1],
        ]
    ];

    /**
     * Set timestamps off
     */
    public $timestamps = false;

    /**
     * A role has many users
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get the company ids of a user in a list
     */
    public function getCompanyListAttribute()
    {
        return $this->companies->lists('id')->toArray();
    }

    /**
     * A role has many permissions
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    /**
     * Get the permissions ids of a role
     */
    public function getPermissionListAttribute()
    {
        return $this->permissions()->lists('id')->toArray();
    }

    /**
     * Find out if role has a specific permission
     *
     * $return boolean
     */
    public function hasPermission($permission)
    {
        return in_array($permission, array_pluck($this->permissions->toArray(), 'machine'));
    }

    /**
     * Attach specific permission to a role
     *
     * $return boolean
     */
    public function attachPermission($permission)
    {
        return $this->permissions()->attach($permission);
    }

    /**
     * Detach specific permission from a role
     *
     * $return boolean
     */
    public function detachPermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * Give permission to a role (sync)
     *
     * $return boolean
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->sync($permission);
    }

    /**
     * Scope a query to only include roles of a company.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFiltered($query)
    {
        $user = Auth::user();

        if(!$user->isAdministrator()) {
            $query->where('id', '>', 1);
        }
    }

}
