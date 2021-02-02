<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_new', function (Blueprint $table) {
            $table->id();
            $table->text('cat_id')->nullable(); 
            $table->date('date')->nullable(); 
            $table->text('titles')->nullable();
            $table->text('details')->nullable();
            $table->text('images')->nullable();
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
        Schema::dropIfExists('tb_new');
    }
}
