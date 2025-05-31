<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Branch;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = Department::all();
        return view("backend.dashboard.layouts.department.table", ['departments' => $department]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $branches = Branch::all();
        // $employees = Employee::all();
        return view("backend.dashboard.layouts.department.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "managerName"=>"required",
            // "branch_id"=>"required",
        ]);

        $department=new Department;
        $department->name=$request->name;
        $department->managerName=$request->managerName;
        // $department->branch_id = $request->branch_id;
        // $branch->user_id=Auth::id();
        $department->save();
        return redirect()->route('departments.index')->withSuccess("Department created successfully.");

    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        // $branches = Branch::all();
        return view('backend.dashboard.layouts.department.edit', [
        'department' => $department,
        // 'branches' => $branches
    ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $department=Department::find($request->department_id);
        $department->name=$request->name;
        $department->managerName=$request->managerName;
        // $department->branch_id = $request->branch_id;

        $department->update();
        return redirect()->route('departments.index')->withSuccess("Department updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department=Department::find($id);
        $department->delete();
        return back()->withSuccess("Department deleted sucessfully");
    }
}
