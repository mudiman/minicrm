<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index');
    }

    public function list()
    {
        return Datatables::of(Employee::query())
            ->addColumn('id', function ($employee) {
                return '<a href="/employees/'. $employee->id .'">'. $employee->id .'</a>';
            })
            ->addColumn('action', function ($employee) {
                $editUrl = route('employees.edit', $employee->id);
                $delUrl = route('employees.destroy', $employee->id);
                $csrf = csrf_field();
                $deleteMethod = method_field("DELETE");
                $x = <<<EOD
                    <a class="btn" href="$editUrl">
                    Edit</i>
                    </a>
                    <form action="$delUrl" method="POST">
                    $csrf
                    $deleteMethod
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are You Sure Want to Delete?')">Delete</a>
                    </form>
                EOD;
                return $x;
            })
            ->rawColumns(['id', 'action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all('name','id');

        return view('employee.create')->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company_id;
        $employee->save();

        return redirect()->route('employees.index')
            ->with('success','Employee inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $company = Company::select('name','id')->where('id', $employee->company_id)->first();
        return view('employee.show',compact('employee'))->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all('name','id');

        return view('employee.edit',compact('employee'))->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->safe()->only(['first_name', 'last_name', 'email', 'phone', 'company_id']);

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success','Employee deleted successfully');
    }
}
