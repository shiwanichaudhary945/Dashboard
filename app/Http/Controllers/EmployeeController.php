<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use App\Models\Branch;

use App\Models\Designation;
use App\Models\Department;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view("backend.dashboard.layouts.user.table", ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        $departments = Department::all();
        $designations = Designation::all();

        return view("backend.dashboard.layouts.user.create",[
            'branches' => $branches,
            'departments' => $departments,
            'designations' => $designations
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "address"=>"required",
            "number"=>"required",
            "email"=>"required",
            "branch_id"=> "required",
            "department_id"=>"required",
            "designation_id"=>"required",

        ]);

        $employee=new Employee;
        $employee->name=$request->name;
        $employee->address=$request->address;
        $employee->number=$request->number;
        $employee->email=$request->email;
        $employee->branch_id = $request->branch_id;
        $employee->department_id = $request->department_id;
        $employee->designation_id = $request->designation_id;

        // $branch->user_id=Auth::id();
        $employee->save();
        return redirect()->route('employees.index')->withSuccess("User created successfully.");

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees=Employee::find($id);
        return view("backend.dashboard.layouts.user.edit",['employees'=>$employees]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employees=Employee::find($request->employee_id);
        $employees->name=$request->name;
        $employees->address=$request->address;
        $employees->number=$request->number;
        $employees->email=$request->email;

        $employees->update();
        return redirect()->route('employees.index')->withSuccess("Employee updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees=Employee::find($id);
        $employees->delete();
        return back()->withSuccess("Employee deleted successfully.");

    }
}
