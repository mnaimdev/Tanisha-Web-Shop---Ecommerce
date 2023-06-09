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
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->string("order_id");
            $table->integer("customer_id");
            $table->string("name");
            $table->string("email");
            $table->string("phone");
            $table->string("company");
            $table->string("address");
            $table->integer("country_id");
            $table->integer("city_id");
            $table->integer("zip");
            $table->longText("notes");
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
        Schema::dropIfExists('billing_details');
    }
};
