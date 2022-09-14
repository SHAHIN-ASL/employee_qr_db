<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeVerificationController extends Controller
{
    public function verifyData($id) 
    {
        $employee = Employee::where('employee_id', $id)->first();

        return view('employee.verification', compact('employee'));
    }
}
