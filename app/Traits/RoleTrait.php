<?php

namespace App\Traits;

trait RoleTrait{
    /**
     * A user has many roles
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Get the role ids of a user in order to be used in edit user form
     */
    public function getRoleListAttribute()
    {
        return $this->roles->lists('id')->toArray();
    }

    /**
     * Get first role of a user
     */
    public function getFirstRole()
    {
        return $this->roles->first();
    }

    /**
     * Find out if User is authenticated, based on if has any roles
     *
     * @return boolean
     */
    public function isAuth()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasRole($role)
    {
        if(is_string($role)){
            return $this->roles->contains('machine', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Assign specific role
     *
     * $return boolean
     */
    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    /**
     * Remove specific role
     *
     * $return boolean
     */
    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Find out if User is administrator
     *
     * @return boolean
     */
    public function isAdministrator()
    {
        return in_array('administrator', $this->roles->lists('machine')->toArray());
    }

    /**
     * Check if user has a specific permission by his role
     * @param $permission
     */
    public function getPermission($permission){
        $role = $this->getFirstRole();

        return $role->hasPermission($permission);
    }
}
