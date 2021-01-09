<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->bigInteger('autor_id')->nullable()->unsigned();
            $table->text('descricao')->nullable();
            $table->enum('status', ['disponivel', 'indisponivel'])->nullable();
            $table->tinyInteger('ativo')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('autor_id')->references('id')->on('autors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
