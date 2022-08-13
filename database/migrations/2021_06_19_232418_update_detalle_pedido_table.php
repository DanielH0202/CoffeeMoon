<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDetallePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detallePedido', function (Blueprint $table) {
            $table->bigInteger('idPedido')->unsigned();
            $table->bigInteger('idAlimento')->unsigned();
            $table->foreign('idPedido')->references('id')->on('pedidos');
            $table->foreign('idAlimento')->references('id')->on('alimentos');
        });
    }

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
