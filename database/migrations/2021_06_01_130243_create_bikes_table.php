<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('valore_noleggio', 8, 2);
            $table->float('valore_acquisto', 8, 2);
            $table->float('valore_vendita', 8, 2);
            $table->string('taglia')->default('M');
            $table->boolean('manutenzione');
            // $table->foreignId('contract_id')->nullable()->constrained();
            $table->foreignId('category_id')->constrained();
            $table->boolean('bloccata')->default(0);
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
        Schema::dropIfExists('bikes');
    }
}
