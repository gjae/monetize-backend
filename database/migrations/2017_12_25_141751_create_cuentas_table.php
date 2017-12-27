<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('nro_cuenta')->index('num');
            $table->enum('tipo_cuenta', ['C', 'A', 'F', 'FC', 'OT'])->index('tipos')->default('C');
            $table->integer('banco_id')->unsigned();
            $table->text('descripcion')->nullable();
            $table->date('fecha_apertura')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('nombe_titular', 25);
            $table->string('apellido_titular', 25);
            $table->string('cedula_titular', 11);
            $table->string('email_titular')->nullable();


            $table->foreign('banco_id')
                    ->references('id')
                    ->on('bancos')
                    ->onDelete('cascade');

            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
