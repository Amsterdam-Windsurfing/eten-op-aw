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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dinner_event_id')->index();
            $table->string('name');
            $table->string('email');
            $table->enum('dinner_option', ['meat', 'vegetarian', 'vegan']);
            $table->text('allergies')->nullable();
            $table->timestamp('registration_verified_at')->nullable();
            $table->timestamps();
            $table->unique(['dinner_event_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};
