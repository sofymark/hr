<?php

namespace App\Http\Controllers\Admin;

use DB;
use Mail;
use App\Models\Employee;
use App\Models\EmployeePersonalInfo;
use App\Models\Country;
use App\Models\Selects;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use App\Traits\BulkActionsTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use PDF;

class EmployeeController extends Controller
{

    use BulkActionsTrait;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
        $route = Route::currentRouteName();
        $this->middleware('permission:'.$route, ['except' => ['dashboard', 'reset', 'resetPassword', 'pdf', 'email']]);
        $this->defaultLocale = 'en';
    }

    /**
     * List of employees
     */
    public function index()
    {
        $employees = Employee::searched()->sorted('username', 'asc')->paginate(25);
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Create an employee
     */
    public function create(){

        return view('admin.employees.create', ['create' => true]);
    }

    /**r
     * Save an employee
     */
    public function store(EmployeeRequest $request)
    {
        $confirmation_code = str_random(30);
        $employee = Employee::create([
            'surname' => $request->surname,
            'name' => $request->name,
            'email' => $request->email,
            'alias' => $request->alias,
            'status' => Employee::STATUS_MAIL_SENT,
            'guid' => $confirmation_code,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ]);

        if($employee)
        {
            $employeePersonalInfo = EmployeePersonalInfo::create([
                'employee_id' => $employee->id,
                'hireDate' => $request->hireDate,
            ]);

            if($employeePersonalInfo)
            {
                Mail::send('email.employeeSendGuid', ['confirmation_code' => $confirmation_code, 'alias' => $request->alias], function ($message) use ($request) {
                    $message->to($request->email, implode(" ",[$request->surname . $request->name]))->subject('SingularLogic - Νέος εργαζόμενος');
                });
            }
        }

        return redirect()->action('Admin\EmployeeController@index');
    }

    /**
     * Show an Employee
     */
    public function show($id)
    {
        $employee = Employee::with(Employee::$employeeRelations)->findOrFail($id);
        $countries = Country::get();
        $selects = Selects::get()->groupBy('forSelect');
        $attachments = $employee->attachments()->get();

        return view('admin.employees.show', compact('employee','attachments','countries','selects'));
    }

    /**
     * Edit an Employee
     */
    public function edit($id){
        $employee = Employee::with(Employee::$employeeRelations)->findOrFail($id);
        $countries = Country::get();
        $selects = Selects::get()->groupBy('forSelect');
        $attachments = $employee->attachments()->get();

        return view('admin.employees.edit', compact('employee','attachments','countries','selects'),['create' => true]);
    }

    /**
     * Print an Employee
     */
    public function pdf($id) {

        $employee = Employee::with(Employee::$employeeRelations)->findOrFail($id);
        $countries = Country::get();
        $selects = Selects::get()->groupBy('forSelect');

        $pdf_title = $employee->surname . ' ' . $employee->name;

        PDF::SetTitle($pdf_title);
        PDF::SetFont('dejavusans', '', 10);
        //PDF::SetFont('freesans');
        $tagvs = array(
            'div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n' => 0)),
        );
        PDF::SetHtmlVSpace($tagvs);

        for($page = 1; $page <= 4; $page++)
        {
            $html = view('admin.employees.pdf.page'.$page, compact('employee','countries','selects'));
            PDF::AddPage();
            PDF::writeHTML($html,true);
        }
        // PDF Output
        PDF::Output($pdf_title . '.pdf');

        //return view('admin.employees.print.page5', compact('employee','countries','selects'));

    }

    /**
     * Update an employee
     */
    public function update(Request $request, $id) {

        $employee = Employee::findOrFail($id);
        $req = $request->all();
        $employee->update($req);

        $request->session()->flash('success', 'User has been updated!');
        return redirect()->action('Admin\EmployeeController@index');
    }

    /**
     * Delete an Employee
     */
    public function destroy($id)
    {
        $user = Employee::findOrFail($id);
        $user->delete();

        //$path = public_path() . '/attachments/'. $id . '/';
        //Storage::deleteDirectory($path);

        return redirect()->action('Admin\EmployeeController@index');
    }

    /**
     * Delete, Activate or Deactivate Bulk Action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulk()
    {
        $this->bulkAction(new Employee);

        return redirect()->action('Admin\EmployeeController@index');
    }

    /**
     * Employee Search
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        Employee::search();
        return redirect()->action('Admin\EmployeeController@index');
    }

    /**
     * Activate / Deactivate row
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update(['active' => $employee->active ? 0 : 1]);

        return redirect()->action('Admin\EmployeeController@index');
    }

    /**
     * Resend Email
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function email($id)
    {
        $employee = Employee::findOrFail($id);

        Mail::send('email.employeeSendGuid', ['confirmation_code' => $employee->guid, 'alias' => $employee->alias], function ($message) use ($employee) {
            $message->to($employee->email, implode(' ', [$employee->surname . $employee->name]))->subject('SingularLogic - Νέος εργαζόμενος');
        });

        return redirect()->action('Admin\EmployeeController@index');
    }

}
