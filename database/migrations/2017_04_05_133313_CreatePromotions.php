<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('promotions', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('order')->unsigned();
        $table->enum('type', ['custom', 'list'])->default('custom');
        $table->text('title')->nullable();
        $table->text('subtitle')->nullable();
        $table->text('info');
        $table->text('image')->nullable();
        $table->boolean('visible')->default(true);
        $table->softDeletes();
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
      Schema::drop('promotions');
    }
}
