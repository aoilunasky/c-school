<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeCardNameCardNumberToPackageHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package_histories', function (Blueprint $table) {
            $table->integer('type')->after('fees')->nullable();
            $table->string('card_name')->after('type')->nullable();
            $table->string('card_number')->after('card_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_histories', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('card_name');
            $table->dropColumn('card_number');
        });
    }
}
