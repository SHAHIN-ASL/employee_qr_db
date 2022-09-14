<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'name',
        'department',
        'designation',
        'personal_email',
        'official_email',
        'personal_number',
        'official_number',
        'joining_date',
        'home_address',
        'ename',
        'ephone',
        'erelation',
        'gender',
        'company_name',
        'employee_role',
        'dob',
        'blood_group',
        'marital_status',
        'image',
        'qrimage',
        'expiry_date',
        'active'
    ];
}
