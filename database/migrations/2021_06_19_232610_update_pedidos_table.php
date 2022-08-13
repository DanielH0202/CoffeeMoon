<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->bigInteger('detalles')->unsigned();
            $table->foreign('detalles')->references('id')->on('detallePedido');
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
