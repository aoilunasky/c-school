<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('teacher_id');
            $table->double('total_hour',4,2)->default(0.00);
            $table->double('amount',8,2)->default(0.00);
            $table->string('receipt_url')->nullable();
            $table->date('date')->default(now());
            $table->timestamps();

            $table->index(['teacher_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
