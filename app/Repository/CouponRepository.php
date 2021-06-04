<?php


namespace App\Repository;


use App\Models\Coupon;
use App\Models\CouponQr;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{

    /**
     * CouponRepository constructor.
     * @param Coupon $coupon
     */
    public function __construct(Coupon $coupon)
    {
        parent::__construct($coupon);
    }

    public function generateQrCode(string $code, string $image)
    {
        $qr = new CouponQr;
        $qr->coupon_code = $code;
        $qr->image = $image;
        $qr->save();

        return $qr;
    }

    /**
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getByQr(string $code): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->findBy(['code' => $code]);
    }
}
