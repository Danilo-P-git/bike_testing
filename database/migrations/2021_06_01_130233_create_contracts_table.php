<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->string('nome');
            $table->string('cognome');
            $table->string('tel');
            $table->string('mail');
            $table->string('nato_a');
            $table->date('nato_il');
            $table->string('comune_residenza');
            $table->string('via_residenza');
            $table->string('n_documento');
            $table->date('data_documento');
            $table->string('ente_documento');
            $table->string('residenza_temp');
            $table->string('path')->nullable()->default(NULL);
            $table->string('sign')->nullable()->default(NULL);
            $table->string('costo')->nullable()->default(NULL);

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
        Schema::dropIfExists('contracts');
    }
}
