<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrupoUsuariosColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('grupo_usuario_id')->unsigned()->nullable()->after('id');
            $table->foreign('grupo_usuario_id')->references('id')->on('grupo_usuarios');
            $table->string('imagem')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_grupo_usuario_id_foreign');
            $table->dropColumn('grupo_usuario_id');
            $table->dropColumn('imagem');
        });
    }
}
