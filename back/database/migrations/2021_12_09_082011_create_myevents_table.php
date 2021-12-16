<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myevents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('user_id')->constrained()->onDelete('CASCADE');
            $table->string('title');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('city');
            $table->string('country');
            $table->text('description');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('myevents');
    }
}