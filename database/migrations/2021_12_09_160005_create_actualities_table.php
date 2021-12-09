<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualities', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('company_id')->notnull();
            $table->string('title')->notnull();
            $table->string('text')->notnull();
            $table->timestamps();
        });

        Schema::table('actualities', function ($table) {
            $table->foreignId('company_id')
                ->constrained('companies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actualities');
    }
}
