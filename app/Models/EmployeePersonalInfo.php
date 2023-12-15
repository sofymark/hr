<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Country;

class EmployeePersonalInfo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'employee_id', 'hireDate', 'gender', 'fatherName', 'motherName', 'birthDate', 'placeBirth',
        'citizenship', 'address', 'region', 'city', 'postalCode', 'phone', 'mobilePhone', 'maritalStatus',
        'militaryObligations', 'militaryObligationsExpiryDate', 'emergencyPersonFullName',
        'emergencyPersonPhone', 'emergencyPersonRelation','identityType', 'identityIssueDate',
        'identityPublisher', 'identityId', 'identityOther', 'passportType', 'passportCountry', 'passportId',
        'passportIssueDate', 'passportExpiryDate','workPermitIssueDate', 'workPermitExpiryDate',
        'tin', 'taxoffice','dateEntryInsurance', 'amka', 'registrationNumberIka', 'insurance',
        'powerNumberTsmede', 'initialDateEntryInsurance','emergencyPersonFullName', 'emergencyPersonPhone',
        'emergencyPersonRelation', 'insurance','cvDocument','tinDocument','maritalStatusDocument',
        'identityDocument','insuranceDocument','passDocument','tsmedeDocument','workPermitDocument',
        'certificationDocument','insuranceOther','iban_holder','iban_number','unemployment_insurance','unemployment_insurance_service'
    ];

    protected $dates = ['hireDate', 'birthDate', 'identityIssueDate','passportIssueDate','passportExpiryDate','workPermitIssueDate','workPermitExpiryDate'];

    protected $appends = ['passport_country_description'];

    protected $table = "employeepersonalinfo";

    protected function getDateFormat(){
        return 'Y-m-d';
    }

    public function getHireDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setHireDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['hireDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getBirthDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setBirthDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['birthDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getIdentityIssueDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setIdentityIssueDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['identityIssueDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getPassportIssueDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setPassportIssueDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['passportIssueDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getPassportExpiryDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setPassportExpiryDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['passportExpiryDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getWorkPermitIssueDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setWorkPermitIssueDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['workPermitIssueDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getWorkPermitExpiryDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setWorkPermitExpiryDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['workPermitExpiryDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getMilitaryObligationsExpiryDateAttribute($value)
    {
        if($value)
        {
            return Carbon::parse($value)->format('d/m/Y');
        }
    }

    public function setMilitaryObligationsExpiryDateAttribute($value)
    {
        if($value)
        {
            $this->attributes['militaryObligationsExpiryDate'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
        }
    }

    public function getPassportCountryDescriptionAttribute()
    {
        $item = Country::where('code', $this->passportCountry)->first();
        return $this->attributes['passport_country_description'] = ($item) ? $item->description : '';
    }
}
