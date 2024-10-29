<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RapidxUser;
use App\Models\UserAccess;
use App\Models\JoRequestConformance;

class JoRequest extends Model
{
    use HasFactory;

    protected $table = "jo_requests";
    protected $connection = "mysql";

    public function rapidx_user_details(){
    	return $this->hasOne(RapidxUser::class, 'id', 'user_id');
    }

    public function rapidx_section_head_details(){
        return $this->hasOne(RapidxUser::class, 'id', 'section_head_id');
    }

    public function user_access_details(){
        return $this->hasOne(UserAccess::class, 'rapidx_id', 'checked_by_id');
    }

    public function jo_requests_conformance(){
        return $this->hasOne(JoRequestConformance::class, 'jo_request_id', 'id');
    }
}
