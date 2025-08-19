<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarqueesTable extends Migration
{
    public function up()
    {
        Schema::create('marquees', function (Blueprint $table) {
            $table->id();
            $table->text('message');             // marquee message content (can contain HTML)
            $table->string('link')->nullable(); // optional URL link
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marquees');
    }
}
