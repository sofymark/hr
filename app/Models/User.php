<?php

namespace App\Models;

use App\Http\Requests\ProfileRequest;
use App\Traits\AccessTrait;
use App\Traits\RoleTrait;
use App\Traits\SearchableTrait;
use App\Traits\SortableTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    protected $redirectTo = '/admin';

    use RoleTrait, SearchableTrait, SortableTrait, AccessTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'auto_login', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $sortable = [
        'columns' => [
            'users.username'                => ['label' => 'Username', 'toggle' => 1],
            'users.name'                 => ['label' => 'Name', 'hide' => 1],
            'role_user.role_id'             => ['label' => 'Role','accessCallback' => 'canAccessRoles', 'hide' => 1],
            'users.active'                  => ['label' => 'Active', 'hide' => 1],
        ]
    ];

    protected $searchable = [
        'columns' => [
            'users.username'                => ['type' => 'string', 'element' => 'text', 'toggle' => 1],
            'users.name'                 => ['type' => 'string', 'element' => 'text', 'hide' => 1],
            'role_user.role_id'             => ['type' => 'int', 'element' => 'lookup', 'lookupModel' => 'App\Models\Role', 'lookupId' => 'id', 'lookupValue' => 'name',  'accessCallback' => 'canAccessRoles', 'hide' => 1],
            'users.active'                  => ['type' => 'int', 'element' => 'yesno', 'hide' => 1],
        ],
        'joins' => [
            'role_user'          => ['users.id', 'role_user.user_id'],
        ],
        'groupBy' => [
            'users.username',
            'users.id',
            'users.name',
            'users.active',
        ],
    ];

    /**
     * A user has many avatars
     */
    public function avatars()
    {
        return $this->belongsToMany('App\Models\Avatar');
    }

    public function scopeFiltered($query)
    {
        $user = Auth::user();

        if(!$user->isAdministrator()) {
            $query->where('id', '>', 1);
        }
    }
}
