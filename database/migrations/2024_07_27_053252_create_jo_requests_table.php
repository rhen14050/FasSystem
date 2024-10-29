<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jo_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jo_ctrl_no');            
            $table->string('department');
            $table->string('date_filed');
            $table->string('equipment_name');
            $table->string('equipment_no');
            $table->string('job_description');
            $table->string('initial_action');
            $table->tinyInteger('currency')->comment = '1 - Dollar, 2 - PHP';                    
            $table->string('allocated_budget');
            $table->string('factory_classification');
            $table->string('file_attachment');
            $table->string('orig_name');
            $table->unsignedTinyInteger('status')->comment = '0-Checked by, 1-SH Approval, 2-For FAS Conformance';
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('checked_by_id');
            $table->unsignedBigInteger('section_head_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('last_updated_by');   
            $table->tinyInteger('logdel')->comment = '0 - active, 1 - deleted';                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jo_requests');
    }
}
