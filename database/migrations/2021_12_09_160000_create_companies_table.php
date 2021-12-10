<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('member_count')->nullable();
            $table->bigInteger('user_id')->notnull();
            $table->integer('siret')->unique()->notnull();
            $table->string('name')->notnull();
            $table->string('adress')->notnull();
            $table->integer('postcode')->notnull();
            $table->string('city')->notnull();
            $table->string('logo_id')->nullable();
            $table->string('colour_background')->nullable();
            $table->string('colour_text')->nullable();
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
        Schema::dropIfExists('companies');
    }
}