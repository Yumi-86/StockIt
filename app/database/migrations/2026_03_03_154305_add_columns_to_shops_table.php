<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')->after('code')->comment('地域コード');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->string('phone')->nullable()->after('region_id');
            $table->string('postal_code', 8)->nullable()->after('phone');
            $table->string('prefecture')->after('postal_code');
            $table->string('city')->after('prefecture');
            $table->string('address_line1')->after('city');
            $table->string('address_line2')->nullable()->after('address_line1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id', 'phone', 'postal_code', 'prefecture', 'city', 'address_line1', 'address_line2']);
        });
    }
}
