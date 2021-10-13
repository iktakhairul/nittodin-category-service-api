<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->string('subcategory_code')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('short_details')->nullable();
            $table->string('status')->default(0)->nullable();
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
        Schema::dropIfExists('sub_categories');
    }
}
