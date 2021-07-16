<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('categories', function (Blueprint $table) {
            $table->decimal('base', 10,2);
            $table->decimal('twoDay', 10,2);
            $table->decimal('threeDay', 10,2);
            $table->decimal('fourDay', 10,2);
            $table->decimal('fiveDay', 10,2);
            $table->decimal('sixDay', 10,2);
            $table->decimal('sevenDay', 10,2);
            $table->decimal('overprice', 10,2);



            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
