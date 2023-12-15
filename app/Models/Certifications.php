<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certifications extends Model
{
    public $timestamps = false;

    protected $table = "certifications";

    protected $fillable = [
        'employee_id',
        'certificationTitle',
        'certificationInstitution',
        'certificationYear'
    ];
}
