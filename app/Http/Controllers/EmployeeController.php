<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employees = Employee::all();
        return view('dashboard', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('add-employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        Employee::create($input);
        return redirect()->route('employee.index')->with('success','Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee) {
        return view('edit-employee',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
        ]);
       $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
        $employee->update($input);
        return redirect()->route('employee.index')->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['success' => true, 'message' => "Employee Delete Successfully"]);
    }
}
