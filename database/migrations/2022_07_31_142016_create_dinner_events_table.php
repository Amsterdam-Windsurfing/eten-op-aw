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
        Schema::create('dinner_events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('cook_name');
            $table->string('cook_email');
            $table->text('description');
            $table->boolean('meat_option');
            $table->boolean('vegetarian_option');
            $table->boolean('vegan_option');
            $table->timestamp('registration_deadline');
            $table->timestamp('event_verified_at')->nullable();
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
        Schema::dropIfExists('dinner_events');
    }
};
