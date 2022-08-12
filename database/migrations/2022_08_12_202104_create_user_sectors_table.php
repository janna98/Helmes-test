<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('sectors');
            $table->foreignId('sector_id')->nullable();
            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors');
            $table->foreignId('industry_id')->nullable();
            $table->foreign('industry_id')
                ->references('id')
                ->on('industries');
            $table->foreignId('product_id')->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->foreignId('product_type_id')->nullable();
            $table->foreign('product_type_id')
                ->references('id')
                ->on('product_types');
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
        Schema::dropIfExists('user_sector');
    }
}
