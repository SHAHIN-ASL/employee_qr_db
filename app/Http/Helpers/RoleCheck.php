<?php

namespace App\Http\Helpers;

use App\Models\Employee;
use App\Models\User;

class RoleCheck
{
    public static function permissionCheck($emp_id)
    {
        $role = Employee::select('employee_role')->where('employee_id', $emp_id)->first();

//        echo '<pre>';
//        print_r($emp_id);die();

        return $role->employee_role;

    }
    public static function roleCheckByLoggedInUser($user_id)
    {
        $userInfo = User::select('emp_id')->where('id', $user_id)->first();
        return self::permissionCheck($userInfo->emp_id);

    }

    public static function findEmployeeIdByLoggedInUserId($user_id)
    {
        $userInfo = User::select('emp_id')->where('id', $user_id)->first();
        return $userInfo->emp_id;

    }

    public static function getLoggedInUserProfileImage($user_id)
    {
        $user = User::select('emp_id')->where('id', $user_id)->first();
        $empInfo = Employee::select('image')->where('employee_id', $user->emp_id)->first();
        return $empInfo->image;

    }
    public static function getLoggedInUserQrCode($user_id)
    {
        $user = User::select('emp_id')->where('id', $user_id)->first();
        $empInfo = Employee::select('qrimage')->where('employee_id', $user->emp_id)->first();
        return $empInfo->qrimage;

    }

}
