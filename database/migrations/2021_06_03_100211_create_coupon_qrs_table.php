<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_qrs', function (Blueprint $table) {
            $table->char('coupon_code',20);
            $table->text('image');
            $table->timestamps();
        });

        Schema::table('coupon_qrs',function (Blueprint $table) {
            $table->foreign('coupon_code')->references('code')->on('coupons')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_qrs');
    }
}
