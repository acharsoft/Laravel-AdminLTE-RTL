<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogleColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id');
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
			$table->integer ('access_level')->default (0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn ('google_id');
            $table->dropColumn ('avatar');
            $table->dropColumn ('avatar_original');
			$table->dropColumn ('access_level');
        });
    }
}
