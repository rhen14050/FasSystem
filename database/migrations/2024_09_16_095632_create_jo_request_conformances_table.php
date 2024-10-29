<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoRequestConformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jo_request_conformances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jo_request_id')->nullable();      
            $table->string('fas_assessment')->nullable();
            $table->string('job_classification')->nullable();
            $table->unsignedTinyInteger('recommendation')->nullable();
            $table->string('others_recommendation')->nullable();
            $table->string('estimated_completion_date')->nullable();
            $table->string('estimated_cost')->nullable();
            $table->unsignedTinyInteger('estimated_type')->nullable();
            $table->string('conformance_remarks')->nullable();
            $table->unsignedTinyInteger('assessed_by');
            $table->unsignedTinyInteger('conformance_status')->comment = ('0-Initial Approval, 1-final_approval_1, 2-final_approval_2, 3-Ongoing');
            $table->string('initial_approval');
            $table->string('initial_approval_datetime')->nullable();
            $table->string('initial_disapproval_datetime')->nullable();
            $table->string('initial_disapproval_remarks')->nullable();

            $table->string('final_approval_1');
            $table->string('final_approval_1_datetime')->nullable();
            $table->string('final_disapproval_1_datetime')->nullable();
            $table->string('final_approval_1_disapproval_remarks')->nullable();

            $table->string('final_approval_2')->nullable();
            $table->string('final_approval_2_datetime')->nullable();
            $table->string('final_disapproval_2_datetime')->nullable();
            $table->string('final_approval_2_disapproval_remarks')->nullable();

            $table->string('completion_datetime')->nullable();
            $table->string('completion_check_datetime')->nullable();
            $table->string('completion_approve_datetime')->nullable();
            $table->string('requestor_conformance_datettime')->nullable();

            
            $table->string('last_updated_by')->nullable();   
            $table->tinyInteger('logdel')->comment = '0 - active, 1 - deleted';                    
            $table->timestamps();

            $table->foreign('jo_request_id')->references('id')->on('jo_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jo_request_conformances');
    }
}
