<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test(){
        $employees = Employee::where(['primary_account'=>1])->get(['employee_id','name','official_email']);

        foreach ($employees as $emp){
            $user = User::create([
                'name' => $emp->name,
                'emp_id'=> $emp->employee_id,
                'email' => $emp->official_email,
                'password' => Hash::make('asl123'),
            ]);

        }
        echo '<pre>';
        print_r('ss');
        die();
    }

}
