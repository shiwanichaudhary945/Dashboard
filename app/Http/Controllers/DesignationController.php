<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Branch;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designation = Designation::all();
        return view("backend.dashboard.layouts.designation.table", ['designations' => $designation]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $branches = Branch::all();
        // $department = Department::all();
        // $employees = Employee::all();
        // $designation = Designation::all();
        return view("backend.dashboard.layouts.designation.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required",
            "salary"=>"required",
            // "branch_id" => "required",
            // "department_id" => "required",

        ]);

        $designation=new Designation;
        $designation->title=$request->title;
        $designation->salary=$request->salary;
        // $designation->branch_id = $request->branch_id;
        // $designation->department_id = $request->department_id;
        // $branch->user_id=Auth::id();
        $designation->save();
        return redirect()->route('designations.index')->withSuccess("Designation title created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $designation = Designation::find($id);
        // $branches = Branch::all();
        // $department = Department::all();

        return view("backend.dashboard.layouts.designation.edit", [
            'designation' => $designation,
            // 'branches' => $branches,
            // 'departments' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $designation = Designation::find($id);
        $designation->title = $request->title;
        $designation->salary = $request->salary;
        // $designation->branch_id = $request->branch_id;
        // $designation->department_id = $request->department_id;
        $designation->update();

        return redirect()->route('designations.index')->withSuccess("Designation updated successfully.");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $designation=Designation::find($id);
        $designation->delete();
        return back()->withSuccess("designation title deleted sucessfully");
    }
}
