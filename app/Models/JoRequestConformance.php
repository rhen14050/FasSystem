<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoRequestConformance extends Model
{
    use HasFactory;

    protected $table = "jo_request_conformances";
    protected $connection = "mysql";

    public function rapidx_user_details(){
    	return $this->hasOne(RapidxUser::class, 'id', 'assessed_by');
    }

    public function rapidx_section_head_details(){
        return $this->hasOne(RapidxUser::class, 'id', 'section_head_id');
    }

    public function user_access_details(){
        return $this->hasOne(UserAccess::class, 'rapidx_id', 'checked_by_id');
    }
}
