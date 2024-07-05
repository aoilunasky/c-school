<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('gender')->nullable();
            $table->tinyInteger('age')->unsigned();
            $table->unsignedTinyInteger('lesson_type')->default(1);// 1 for individual lesson , 2 for group lesson
            $table->text('purpose')->nullable();
            $table->unsignedInteger('ticket_amt')->default(0);
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
        Schema::dropIfExists('students');
    }
}
