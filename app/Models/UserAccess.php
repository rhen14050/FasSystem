<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RapidxUser;

class UserAccess extends Model
{
    use HasFactory;

    protected $guarded = ['rapidx_id']; 

    protected $table = "user_accesses";
    protected $connection = "mysql";

    public function rapidx_user_details(){
    	return $this->hasOne(RapidxUser::class, 'id', 'rapidx_id');
    }
}
