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
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropUnique('event_registrations_dinner_event_id_email_unique');

            $table->integer('plus_one')->default(0);
            $table->unique(['dinner_event_id', 'email', 'plus_one']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn('plus_one');
            $table->dropUnique('event_registrations_dinner_event_id_email_plus_one_unique');

            $table->unique(['dinner_event_id', 'email']);
        });
    }
};
