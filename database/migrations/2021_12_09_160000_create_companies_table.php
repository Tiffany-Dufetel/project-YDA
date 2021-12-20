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
            $table->string('name')->notnull();
            $table->integer('member_count')->nullable();
            $table->integer('number')->nullable();
            $table->char('siret',14)->unique()->notnull();
            $table->string('adress')->notnull();
            $table->char('postcode',5)->notnull();
            $table->string('city')->notnull();
            $table->string('logo_id')->nullable();
            $table->string('colour_background')->nullable();
            $table->string('colour_text')->nullable();
            $table->string('day')->nullable();
            $table->string('time')->nullable();
            $table->string('dayTwo')->nullable();
            $table->string('timeTwo')->nullable();
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
