<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->char('code','20')->primary();
            $table->unsignedBigInteger('promotion_id');
            $table->decimal('discount_value');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::table('coupons',function (Blueprint $table) {
            $table->foreign('promotion_id')->references('id')->on('promotions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
