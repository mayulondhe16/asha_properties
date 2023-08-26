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
        Schema::table('property_types', function (Blueprint $table) {
            $table->string('total_area');
            $table->string('plot_area');
            $table->string('location');
            $table->boolean('status')->default(false);
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
        Schema::table('property_types', function (Blueprint $table) {
            $table->dropColumn('total_area');
            $table->dropColumn('status');
            $table->dropColumn('plot_area');
            $table->dropColumn('location');
        });
    }
};
