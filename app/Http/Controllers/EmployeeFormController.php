<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\Models\Country;
use App\Models\Employee;
use App\Models\EmployeePersonalInfo;
use App\Models\ProtectedMember;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Selects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

class EmployeeFormController extends Controller
{
    public function login(Request $request)
    {
        $guid = $request->guid;
        if($guid)
        {
            $id = Employee::active($guid)->firstOrFail();
            if ($id) {
                return redirect(route('welcome', ['guid' => $request->guid]));
            }
        }
        return view('layouts.login');
    }


    public function bind($guid)
    {
        $employee = Employee::active($guid)->with(Employee::$employeeRelations)->firstOrFail();

        if ($employee)
        {
            $countries = Country::get();
            $selects = Selects::get()->groupBy('forSelect');
            $attachments = $employee->attachments()->get();

            return view('employee.form', compact('guid', 'employee', 'countries', 'selects', 'attachments'));
        }
        abort(404);
    }

    public function attachments($guid)
    {
        $employee = Employee::active($guid)->firstOrFail();
        if ($employee) {
            $attachments = $employee->attachments()->get()->tojSon();
            return response()->json($attachments);
        }
        abort(404);
    }


    public function store(Request $request, $guid)
    {
        $employee = Employee::active($guid)->with(Employee::$employeeRelations)->firstOrFail();

        $state = (isset($request['temp'])) ? Employee::STATUS_SAVE_TEMP : Employee::STATUS_FOR_REVIEW;
        $updateSection = ($request->updateSection) ? json_decode($request->updateSection) : null;
        $data = $this->groupData($request);
        return $employee->storeEmployeeInfo($data, $state, $updateSection);
    }

    public function uploadFile($guid)
    {
        $employee = Employee::active($guid)->firstOrFail();
        if ($employee && !empty($_FILES)) {
            $attachment = new Attachment();
            $attachment->saveAs($employee->id);
        }
    }

    public function deleteFile($guid, $attachment_id)
    {
        $employee = Employee::active($guid)->firstOrFail();
        $attachment = Attachment::where('employee_id','=', $employee->id)->where('id','=',$attachment_id)->first();

        if(count($attachment))
        {
            try
            {
                $attachment->deleteFile();
                return ['success' => true];
            }
            catch(Exception $e)
            {
                return ['success' => false];
            }
        }
    }

    /**
     * Show employees in ready state for hcm
     */
    public function hcm($token)
    {
        $user = User::where('auto_login',$token)->firstOrFail();

        if(Auth::loginUsingId($user->id))
        {
            $employees = Employee::with(Employee::$employeeRelations)->forHCM()->get();
            return response()->json($employees);
        }
        abort(404);

    }

    public function hcmDone($guid) {

        $employee = Employee::where('guid', $guid)->firstOrFail();

        if ($employee->status == Employee::STATUS_COMPLETED)
        {
            $employee->status = Employee::STATUS_HCM_MIGRATED;
            $employee->error_description = '';
            $employee->update();
        }

        return response()->json(['success' => true]);
    }

    public function hcmFailed($guid, Request $request) {

        $employee = Employee::where('guid', $guid)->firstOrFail();

        if ($employee->status == Employee::STATUS_COMPLETED)
        {
            $employee->status = Employee::STATUS_HCM_FAILED;
            $employee->error_description = (isset($request['reason'])) ? $request['reason'] : 'Unknown';
            $employee->update();
        }

        return response()->json(['success' => true]);
    }


    private function groupData($request)
    {
        $data = [];
        foreach (Employee::$employeeRelations as $table) {
            $data[$table] = $request->$table;
            unset($request->$table);
        }
        $tmp = $request->all();
        unset($tmp['_token']);
        $data[Employee::TABLE_EMPLOYEE_PERSONAL_INFO] = json_encode([$tmp], true);
        return $data;
    }

}
