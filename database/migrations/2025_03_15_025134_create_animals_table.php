<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('animals')) {
            Schema::create('animals', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('breed');
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }
    }


    public function down()
    {
        Schema::dropIfExists('animals');
    }
};
