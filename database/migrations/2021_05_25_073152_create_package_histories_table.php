<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->unsignedInteger('student_id');
            $table->date('date')->default(now());
            $table->tinyInteger('status');// 0 pending , 1// success
            $table->integer('ticket_amt')->default(0);
            $table->double('fees',8,2)->default(0.00);
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
        Schema::dropIfExists('package_histories');
    }
}
