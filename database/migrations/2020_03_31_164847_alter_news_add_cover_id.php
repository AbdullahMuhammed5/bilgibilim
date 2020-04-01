<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNewsAddCoverId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table){
            $table->unsignedBigInteger('cover_id')->after('views')->nullable();
            $table->foreign('cover_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table){
            $table->dropForeign(['cover_id']);
            $table->dropColumn('cover_id');
        });
    }
}
