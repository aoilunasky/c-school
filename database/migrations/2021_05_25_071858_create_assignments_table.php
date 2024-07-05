<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('student_id');
            $table->unsignedSmallInteger('subject_id');
            $table->string('question_url');
            $table->date('deadline')->nullable();
            $table->smallInteger('status')->default(1); // 1 for given 2 for answered 3 for overdue
            $table->softDeletes();
            $table->timestamps();

            $table->index(['teacher_id', 'student_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
