<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDatesFromEventsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->date('date')->nullable();
        });
    }
}
