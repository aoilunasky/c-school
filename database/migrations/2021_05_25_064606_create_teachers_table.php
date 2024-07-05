<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('job_type'); //1 for full time , 2 for part time
            $table->double('salary_rate', 8, 2);
            $table->string('profile_image')->nullable();
            $table->integer('country_id')->nullable();
            $table->text('responsibility')->nullable();
            $table->string('address')->nullable();
            $table->string('education')->nullable();
            $table->text('job_history')->nullable();
            $table->text('certificates')->nullable();
            $table->text('strong_points')->nullable();
            $table->string('skype_link')->nullable();
            $table->string('zoom_link')->nullable();
            $table->string('nrc')->nullable();
            $table->string('passport')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('teachers');
    }
}
