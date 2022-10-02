<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reason');       //Reson     
            $table->unsignedBigInteger('applier_user_id'); // Applier user id
            $table->date('start_date'); // Date
            $table->date('end_date')->nullable(); //date
            $table->string('status')->default('pending');//Status of leave application
            $table->unsignedBigInteger('leave_type_id')->default('1'); //Leave type casual leave
            $table->unsignedBigInteger('authorizer_user_id')->nullable();
            $table->float('number_of_days'); //number of days leave           
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
        Schema::dropIfExists('leave_applications');
    }
}
