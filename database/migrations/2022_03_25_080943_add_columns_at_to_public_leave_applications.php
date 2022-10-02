<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAtToPublicLeaveApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('public_leave_applications', function (Blueprint $table) {
            
            $table->string('public_leave_name');
            $table->string('applier_user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public_leave_applications', function (Blueprint $table) {
            //
        });
    }
}
