<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('cuenta_id')->unsigned();
            $table->enum('tipo_movimiento', ['T', 'D', 'OT']);
            $table->date('fecha_movimiento');
            $table->string('nro_ref', 60)->index('ref');
            $table->enum('nota', ['C', 'D']);
            $table->double('monto');
            $table->text('descripcion')->nullable();

            $table->foreign('cuenta_id')->references('id')
                    ->on('cuentas')
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
        Schema::dropIfExists('movimientos');
    }
}
