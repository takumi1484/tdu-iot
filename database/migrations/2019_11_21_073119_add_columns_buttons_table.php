<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buttons', function (Blueprint $table) {
            $table->string('color');
            $table->unsignedInteger('sort_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buttons', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('sort_no');
        });
    }
}
