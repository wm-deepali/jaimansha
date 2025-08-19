<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();      // optional title or description
            $table->boolean('active')->default(true); // to enable/disable popup globally
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('popups');
    }
}
