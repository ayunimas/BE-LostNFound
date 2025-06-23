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
        Schema::create("identity_person", function (Blueprint $table) {
            $table->id();
            $table->string("cat_identity");
            $table->text("image_path");
            $table->unsignedBigInteger("id_user");
            $table->timestamps();

            $table->foreign("id_user")->references("id")->on("user");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("identity_person");
    }
};
