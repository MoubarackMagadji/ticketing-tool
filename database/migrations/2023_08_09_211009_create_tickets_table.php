<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('rdept_id')->foreign('rdept_id')->references('id')->on('depts');
            $table->bigInteger('ruser_id')->foreign('ruser_id')->references('id')->on('users');
            $table->boolean('depticket')->default(false);
            $table->longText('description')->nullable();
            $table->bigInteger('category_id')->foreign('category_id')->references('id')->on('categories');
            $table->bigInteger('subcategory_id')->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->bigInteger('dept_id')->foreign('dept_id')->references('id')->on('depts');
            $table->bigInteger('status_id')->foreign('status_id')->references('id')->on('statuses');
            $table->bigInteger('priority_id')->foreign('priority_id')->references('id')->on('priorities');
            $table->bigInteger('user_id')->foreign('user_id')->references('id')->on('users');
            $table->longText('attachedFiles')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
