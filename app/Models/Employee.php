<?php

namespace App\Models;

use DB;
use Mail;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchableTrait;
use App\Traits\SortableTrait;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception ;
use Exception as MailConfigurationException;

class Employee extends Model
{

    use SearchableTrait, SortableTrait;

    protected $sortable = [
        'columns' => [
            'employee.surname' => ['label' => 'Surname', 'toggle' => 1],
            'employee.name' => ['label' => 'Name'],
            'employee.email' => ['label' => 'Email'],
            'employee.status' => ['label' => 'Status'],
            'employeePersonalInfo.hireDate' => ['label' => 'Hire Date'],
        ]
    ];

    protected $searchable = [
        'columns' => [
            'employee.surname' => ['type' => 'string', 'element' => 'text'],
            'employee.name' => ['type' => 'string', 'element' => 'text'],
            'employee.email' => ['type' => 'string', 'element' => 'text'],
            'employee.status' => ['type' => 'int', 'element' => 'array', 'values' => [2 => 'Temporary Saved', 3 => 'For Preview by HR', 4 => 'Ready for HCM', 5 => 'Transfer - OK', 6 => 'Transfer - Failed']],
            'employeePersonalInfo.hireDate' => ['type' => 'date', 'element' => 'date'],
        ],
        'groupBy' => [
            'employee.surname',
            'employee.id',
            'employee.name',
            'employee.status',
            'employeePersonalInfo.hireDate'
        ],
        'joins' => [
            'employeePersonalInfo' => ['employee.id','employeePersonalInfo.employee_id'],
        ]
    ];

    const
        TABLE_EMPLOYEE = 'employee',
        TABLE_PROTECTED_MEMBER = 'protectedMember',
        TABLE_EMPLOYEE_PERSONAL_INFO = 'employeePersonalInfo',
        TABLE_EDUCATIONS = 'education',
        TABLE_CERTIFICATIONS = 'certification',
        TABLE_EXPERIENCE = 'experience',
        TABLE_LANGUAGES = 'language',
        STATUS_MAIL_SENT = 1,
        STATUS_SAVE_TEMP = 2,
        STATUS_FOR_REVIEW = 3,
        STATUS_COMPLETED = 4,
        STATUS_HCM_MIGRATED = 5,
        STATUS_HCM_FAILED = 6;

    public static $employeeRelations = array(
        self::TABLE_PROTECTED_MEMBER,
        self::TABLE_EMPLOYEE_PERSONAL_INFO,
        self::TABLE_EDUCATIONS,
        self::TABLE_CERTIFICATIONS,
        self::TABLE_EXPERIENCE,
        self::TABLE_LANGUAGES
    );

    protected $table = self::TABLE_EMPLOYEE;

    protected $primaryKey = 'id';

    protected $fillable = [
        'surname','name','email','alias','guid','status','error_description','ip_address'
    ];

    public function storeEmployeeInfo($data, $state, $updateSection = null)
    {
        DB::beginTransaction();
        try {
            $tables = ($updateSection) ? $updateSection : Employee::$employeeRelations;
            foreach ($tables as $table) {
                $jsonString = $data[$table];
                if ((gettype($jsonString) == 'string') && ($jsonString)) {
                    $this->deleteOld($table);
                    $arrayOfObj = json_decode($jsonString, true);
                    foreach ($arrayOfObj as $obj) {
                        $this->validations($table, $obj);
                        $model = $this->instatiateModelByTableName($table, $obj);
                        $result = $this->$table()->save($model);
                    }
                }
            }

            // // if you are authenticated (admins) you can autosave the form during navigation
            // // but dont change the status
            // if(!Auth::user())
            // {
            $this->status = $state;
            // }


            $this->save();
            DB::commit();
        } catch (MailConfigurationException $ex) {
            DB::rollback();
            return ['success' => false, 'message' => $ex->getMessage()];
        }

        if($state == self::STATUS_FOR_REVIEW)
        {
            try {
                Mail::send('email.employeeFormCompleted', ['name' => $this->surname . ' ' . $this->name], function ($message) {
                    $message->to(env('MAIL_FROM_EMAIL'),env('MAIL_FROM_NAME'))->subject('SingularLogic - Ολοκλήρωση Φόρμας');
                });
            }
            catch(MailConfigurationException $e){}
        }

        return ['success' => true];
    }

    protected function validations($table, $obj)
    {
        // switch ($table) {
        //     case self::TABLE_EMPLOYEE_PERSONAL_INFO:
        //         $this->employeePersonInfoValidations($obj);
        //         break;
        //     case self::TABLE_PROTECTED_MEMBER:
        //         $this->protectedMemberValidations($obj);
        //         break;
        //     case self::TABLE_EDUCATIONS:
        //         $this->educationValidations($obj);
        //         break;
        //     case self::TABLE_CERTIFICATIONS:
        //         $this->certificationValidations($obj);
        //         break;
        //     case self::TABLE_EXPERIENCE:
        //         $this->experienceValidations($obj);
        //         break;
        // }
    }

    // @@@ Validations @@@

    private function employeePersonInfoValidations($obj)
    {
        $fieldReq = [
            'hireDate', 'gender','fatherName','motherName','birthDate','placeBirth','citizenship',
            'address','region','city','postalCode','phone','mobilePhone','maritalStatus','emergencyPersonFullName',
            'emergencyPersonPhone', 'emergencyPersonRelation'
        ];

        foreach($fieldReq as $field) {
            if (!isset($obj[$field]) || $obj[$field] === '') {
                throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία.');
            }
        }

        if($obj['gender'] == '0'){
            if (!$obj['militaryObligations']) {
                throw new Exception('Πρέπει να συμπληρώσετε το πεδίο "Στρατιωτικές υποχρεώσεις".');
            } else {
                if ((int)$obj['militaryObligations'] == 2 && !$obj['militaryObligationsExpiryDate']) {
                    throw new Exception('Πρέπει να συμπληρώσετε το πεδίο "Λήξη αναβολής".');
                }
            }
        }

    }

    private function protectedMemberValidations($obj)
    {
        $fieldReq = [
            'protectedMemberLastName', 'protectedMemberFirstName', 'protectedMemberBirthDate', 'protectedMemberRelation'
        ];

        foreach($fieldReq as $field) {
            if ($obj[$field] == '') {
                throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία στα προστατευόμενα μέλη.');
            }
        }
    }

    private function educationValidations($obj)
    {
        if ($obj['educationTitle'] == '') {
            throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία.');
        }
        if ($obj['educationType'] == '') {
            throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία.');
        }
        if (($obj['educationType'] == '1') || ($obj['educationType'] == '2') || ($obj['educationType'] == '5')) {
            if ((!$obj['educationInstitution']) || (!$obj['educationDepartment'])) {
                throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία.');
            }
        } else {
            if ($obj['educationTypeOther'] == '') {
                throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία.');
            }
        }
    }

    private function certificationValidations($obj)
    {
        $fieldReq = [
            'certificationTitle','certificationInstitution','certificationYear'
        ];

        foreach($fieldReq as $field) {
            if ($obj[$field] == '') {
                throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία στις πιστοποιήσεις.');
            }
        }
    }

    private function experienceValidations($obj)
    {
        $fieldReq = [
            'experienceDateFrom','experienceDateTo','experienceCompany','experiencePosition'
        ];

        foreach($fieldReq as $field) {
            if (!$obj[$field] == '') {
                throw new Exception('Δεν έχουν συμπληρωθεί όλα τα υποχρεωτικά πεδία στα προστατευόμενα μέλη.');
            }
        }
    }

    private function instatiateModelByTableName($table, $obj = array())
    {
        $model = null;
        switch ($table) {
            case self::TABLE_PROTECTED_MEMBER:
                $model = new ProtectedMember($obj);
                break;
            case self::TABLE_EMPLOYEE_PERSONAL_INFO:
                $model = new EmployeePersonalInfo($obj);
                break;
            case self::TABLE_EDUCATIONS:
                $model = new Educations($obj);
                break;
            case self::TABLE_CERTIFICATIONS:
                $model = new Certifications($obj);
                break;
            case self::TABLE_EXPERIENCE:
                $model = new Experience($obj);
                break;
            case self::TABLE_LANGUAGES:
                $model = new Languages($obj);
                break;
            default:
                throw new Exception("Cannot find Model.", 1);
                break;
        }

        $model = $this->setDefaultValues($model);
        return $model;
    }

    private function setDefaultValues($model)
    {
        $model->employee_id = $this->id;
        return $model;
    }

    private function deleteOld($table)
    {
        switch ($table) {
            case self::TABLE_PROTECTED_MEMBER:
                ProtectedMember::where('employee_id', '=', $this->id)->delete();
                break;
            case self::TABLE_EMPLOYEE_PERSONAL_INFO:
                EmployeePersonalInfo::where('employee_id', '=', $this->id)->delete();
                break;
            case self::TABLE_EDUCATIONS:
                Educations::where('employee_id', '=', $this->id)->delete();
                break;
            case self::TABLE_CERTIFICATIONS:
                Certifications::where('employee_id', '=', $this->id)->delete();
                break;
            case self::TABLE_EXPERIENCE:
                Experience::where('employee_id', '=', $this->id)->delete();
                break;
            case self::TABLE_LANGUAGES:
                Languages::where('employee_id', '=', $this->id)->delete();
                break;
//            case self::TABLE_ATTACHMENTS:
//                Attachment::where('employee_id', '=', $this->id)->delete();
//                break;
        }
    }

    // @@@ Relations @@@

    public function protectedMember()
    {
        return $this->hasMany(ProtectedMember::class);
    }

    public function employeePersonalInfo()
    {
        return $this->hasOne(EmployeePersonalInfo::class);
    }

    public function education()
    {
        return $this->hasMany(Educations::class);
    }

    public function certification()
    {
        return $this->hasMany(Certifications::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function language()
    {
        return $this->hasMany(Languages::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function scopeActive($query, $guid) {
        return $query->where('guid', '=', $guid)->whereIn('status',[self::STATUS_MAIL_SENT, self::STATUS_SAVE_TEMP]);
    }

    public function scopeForHCM($query) {
        return $query->where('status', self::STATUS_COMPLETED);
    }

}
