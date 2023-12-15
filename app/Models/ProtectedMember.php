<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProtectedMember extends Model
{
    public $timestamps = false;

    protected $table = "protectedmember";

    protected $dates = ['protectedMemberBirthDate'];

    protected $fillable = [
        'employee_id',
        'protectedMemberLastName',
        'protectedMemberFirstName',
        'protectedMemberBirthDate',
        'protectedMemberRelation'
    ];

    protected function getDateFormat(){
        return 'Y-m-d';
    }

}
