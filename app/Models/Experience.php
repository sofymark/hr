<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Experience extends Model
{
    public $timestamps = false;

    protected $table = "experience";

    protected $dates = ['experienceDateFrom', 'experienceDateTo'];

    protected $fillable = [
        'employee_id',
        'experienceDateFrom',
        'experienceDateTo',
        'experienceCompany',
        'experiencePosition'
    ];

    protected function getDateFormat(){
        return 'Y-m-d';
    }

}
