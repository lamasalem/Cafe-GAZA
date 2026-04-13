<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.employee.index', compact('employees'));
    }

    public function create()
    {
        return response()->view('cms.employee.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Job_Title' => 'required|string|min:2',
            'Email' => 'required|email|unique:employees,Email',
            'Password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $employee = new Employee();
            $employee->Job_Title = $request->get('Job_Title');
            $employee->Email = $request->get('Email');
            $employee->Password = Hash::make($request->get('Password'));
            $employee->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Employee added successfully!'
            ], 200);
        }
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->view('cms.employee.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->view('cms.employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'Job_Title' => 'required|string|min:2',
            'Email' => 'required|email|unique:employees,Email,' . $id,
            'Password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ], 400);
        } else {
            $employee = Employee::findOrFail($id);
            $employee->Job_Title = $request->get('Job_Title');
            $employee->Email = $request->get('Email');
            if ($request->get('Password')) {
                $employee->Password = Hash::make($request->get('Password'));
            }
            $employee->save();

            return ['redirect' => route('employees.index')];
        }
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }
}