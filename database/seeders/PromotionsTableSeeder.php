<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\CouponQr;
use App\Models\Promotion;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $promotion = new Promotion;
            $promotion->description = Str::random(20);
            $promotion->expired_at = Carbon::now()->addDays(rand(1,10));
            $promotion->company = Str::random(10);
            $promotion->save();

            $coupon = new Coupon;
            $coupon->promotion_id = $promotion->id;
            $coupon->code = Str::random(20);
            $coupon->discount_value = rand(1,60);
            $coupon->save();


            $qr = new CouponQr;
            $qr->coupon_code = $coupon->code;
            $qr->image = QrCode::size('100')->generate($coupon->code);
            $qr->save();


        }
    }
}
