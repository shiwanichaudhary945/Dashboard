<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $creatorName = Auth::user()->name;
        $branches = Branch::all();
        return view("backend.dashboard.layouts.branch.table", ['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $employees = Employee::all(); //fetch employee
        return view("backend.dashboard.layouts.branch.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "branchName"=>"required",
            "location"=>"required",
            "number"=>"required",
            "email"=>"required",
        ]);

        $branch=new Branch;
        $branch->name=$request->branchName;
        $branch->location=$request->location;
        $branch->number=$request->number;
        $branch->email=$request->email;
        // $branch->user_id=Auth::id();
        $branch->save();
        return redirect()->route('branches.index')->withSuccess("Branch created successfully.");

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branches=Branch::find($id);
        return view("backend.dashboard.layouts.branch.edit",['branches'=>$branches]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branches=Branch::find($request->branch_id);
        $branches->name=$request->branchName;
        $branches->location=$request->location;
        $branches->number=$request->number;
        $branches->email=$request->email;

        $branches->update();
        return redirect()->route('branches.index')->withSuccess("Branch updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branches=Branch::find($id);
        $branches->delete();
        return back()->withSuccess("branch deleted sucessfully");
    }
}

