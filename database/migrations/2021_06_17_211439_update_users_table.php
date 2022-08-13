<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('idDireccion')->unsigned();
            $table->foreign('idDireccion')->references('id')->on('direcciones');
        });
        
    }*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
