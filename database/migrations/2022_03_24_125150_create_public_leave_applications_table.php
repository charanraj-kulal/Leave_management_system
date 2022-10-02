<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applier_user_id');
            $table->unsignedBigInteger('leave_type_id')->default('2');
            $table->unsignedBigInteger('public_leave_id');
            $table->unsignedBigInteger('authorizer_user_id')->nullable();
            $table->string('status')->default('approved');
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
        Schema::dropIfExists('public_leave_applications');
    }
}
