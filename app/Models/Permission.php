<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use App\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use SearchableTrait, SortableTrait;

    /**
     * Fillable fields
     */
    protected $fillable = [
        'name', 'machine', 'description', 'group'
    ];

    protected $sortable = [
        'columns' => [
            'name'          => ['label' => 'Name', 'toggle' => 1],
            'machine'       => ['label' => 'Machine Name', 'hide' => 1],
            'group'         => ['label' => 'Group', 'hide' => 1],
        ]
    ];

    protected $searchable = [
        'columns' => [
            'name'          => ['type' => 'string', 'element' => 'text', 'toggle' => 1],
            'machine'       => ['type' => 'string', 'element' => 'text', 'hide' => 1],
            'group'         => ['type' => 'string', 'element' => 'text', 'hide' => 1],

        ]
    ];

    /**
     * A permission belongs to many roles
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

}
