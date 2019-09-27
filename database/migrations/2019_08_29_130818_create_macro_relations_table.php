<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMacroRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('macro_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('macro_id');
            $table->unsignedInteger('button_id');
            $table->unsignedInteger('calling_number');
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
        Schema::dropIfExists('macro_relations');
    }
}
