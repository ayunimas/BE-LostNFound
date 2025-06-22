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
        Schema::create('item', function (Blueprint $table) {
            $table->id();
            $table->string('nm_item');
            $table->string('color');
            $table->string('brand');
            $table->string('weight');
            $table->morphs('itemable');
            $table->unsignedBigInteger('id_catItem');
            $table->timestamps();

            $table->foreign('id_catItem')->references('id')->on('category_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item');
    }
};
