<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RapidXDepartment;
use App\Models\SystemoneHRIS;

class RapidxUser extends Model
{
    // use HasFactory;
    protected $table = "users";
    protected $connection = "mysql_rapidx";

    public function department_details(){
        return $this->hasOne(RapidXDepartment::class, 'department_id', 'department_id');
    }

    // public function hris_details(){
    //     return $this->hasOne(SystemoneHRIS::class, 'EmpNo', 'employee_number');
    // }
}
