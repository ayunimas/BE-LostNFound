<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pickup_request", function (Blueprint $table) {
            $table->id();
            $table->string("status");
            $table->unsignedBigInteger("id_found");
            $table->unsignedBigInteger("id_person");
            $table->timestamps();

            $table->foreign("id_found")->references("id")->on("found");
            $table
                ->foreign("id_person")
                ->references("id")
                ->on("identity_person");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("pickup_request");
    }
};
