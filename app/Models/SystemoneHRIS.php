<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemoneHRIS extends Model
{
    use HasFactory;

    protected $table = "tbl_EmployeeInfo";
    protected $connection = "mysql_systemone_hris";
}
