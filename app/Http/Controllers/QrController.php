<?php

namespace App\Http\Controllers;

use App\Models\CouponQr;
use App\Repository\CouponRepositoryInterface;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    /** @var CouponRepositoryInterface  */
    private CouponRepositoryInterface $couponRepository;

    /**
     * QrController constructor.
     * @param CouponRepositoryInterface $couponRepository
     */
    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }


    /**
     *
     */
    public function generate()
    {

    }
}
