<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idCliente")->unsigned();
            $table->bigInteger('idRepartidor')->unsigned();
            $table->string('estatusPedido');
            $table->timestamps();
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->foreign('idRepartidor')->references('id')->on('repartidores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
