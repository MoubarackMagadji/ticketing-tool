<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsOnTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs_on_ticket', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('ticket_id')->foreign('ticket_id')->references('id')->on('tickets');
            $table->boolean('ismain')->default(false);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('staffs_on_ticket');
    }
}
