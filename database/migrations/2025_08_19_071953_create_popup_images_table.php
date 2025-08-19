<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupImagesTable extends Migration
{
    public function up()
    {
        Schema::create('popup_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('popup_id')->constrained()->onDelete('cascade');
            $table->string('image_path');            // path of popup image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('popup_images');
    }
}
