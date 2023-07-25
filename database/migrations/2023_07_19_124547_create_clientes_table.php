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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("genero");
            $table->string("nombre");
            $table->string("apellido");
            $table->string("direccion_tipo_calle");
            $table->string("direccion_calle");
            $table->string("direccion_adicional_1");
            $table->string("direccion_codigo_postal");
            $table->string("direccion_ciudad");
            $table->string("dni");
            $table->string("telefono_1");
            $table->string("telefono_2");
            $table->string("telefono_3");
            $table->string("email_1");
            $table->string("email_2");
            $table->string("email_3");
            $table->string("comunicacion_postal");
            $table->string("comunicacion_email");
            $table->string("comunicacion_sms");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
