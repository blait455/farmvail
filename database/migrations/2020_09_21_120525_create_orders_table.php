<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->string('state');
            $table->string('post_code');
            $table->string('phone_number');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            // $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
