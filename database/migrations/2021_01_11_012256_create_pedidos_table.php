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
            $table->bigInteger('livro_id')->unsigned();
            $table->bigInteger('cliente_id')->unsigned();
            $table->enum('status_pedido', ['solicitado', 'aprovado', 'negado', 'devolvivo'])->nullable()->default('solicitado');
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('usuário que atualizou o pedido');
            $table->dateTime('prazo_devolucao')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('livro_id')->references('id')->on('livros');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
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
