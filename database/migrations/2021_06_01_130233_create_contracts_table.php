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
            $table->string('tel')->nullable()->default(NULL);
            $table->string('mail')->nullable()->default(NULL);
            $table->string('nato_a')->nullable()->default(NULL);
            $table->date('nato_il')->nullable()->default(NULL);
            $table->string('comune_residenza')->nullable()->default(NULL);
            $table->string('via_residenza')->nullable()->default(NULL);
            $table->string('n_documento')->nullable()->default(NULL);
            $table->date('data_documento')->nullable()->default(NULL);
            $table->string('ente_documento')->nullable()->default(NULL);
            $table->string('residenza_temp')->nullable()->default(NULL);
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
