<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id');
            $table->string('users_phone')->nullable()->default(0);
            $table->text('address')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('total_point')->default(0)->nullable();
            $table->float('shipping_price')->default(0);
            $table->string('status')->default('PENDING');
            $table->string('payment')->default('MANUAL');
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
        Schema::dropIfExists('transactions');
    }
}
