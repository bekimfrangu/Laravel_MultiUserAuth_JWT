<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('provider_id')->unsigned();
            $table->decimal('amount', 8, 2);
            $table->string('status')->default(0);
            $table->timestamps();
            
            $table->foreign('type_id')->references('id')->on('payment_types')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('payment_providers')->onDelete('cascade');
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
};
