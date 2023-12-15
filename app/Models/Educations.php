<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    public $timestamps = false;

    protected $table = "educations";

    protected $fillable = [
        'employee_id',
        'educationTitle',
        'educationType',
        'educationTypeOther',
        'educationInstitution',
        'educationDepartment'
    ];
}
