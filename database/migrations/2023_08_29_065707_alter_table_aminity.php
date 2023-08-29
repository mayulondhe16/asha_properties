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
        Schema::table('aminity', function (Blueprint $table) {
            $table->string('amenityicon');
            $table->string('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aminity', function (Blueprint $table) {
            $table->dropColumn('amenityicon');
            $table->dropColumn('status');
        });
    }
};
