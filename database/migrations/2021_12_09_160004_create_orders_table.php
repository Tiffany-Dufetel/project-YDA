<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('product_id')->notnull();
            // $table->bigInteger('user_id')->notnull();
            $table->enum('status', ['en attente', 'en cours', 'terminé'])->default('en attente');
            $table->date('date_order')->nullable();
            $table->date('date_delivery')->nullable();
            $table->string('comment')->nullable();
            $table->string('pdf')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function ($table) {
            $table->foreignId('products_id')
                ->constrained('products')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
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
        Schema::dropIfExists('orders');
    }
}
