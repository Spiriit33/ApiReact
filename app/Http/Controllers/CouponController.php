<?php

namespace App\Http\Controllers;

use App\Repository\CouponRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /** @var CouponRepositoryInterface  */
    private CouponRepositoryInterface $couponRepository;

    /**
     * CouponController constructor.
     * @param CouponRepositoryInterface $couponRepository
     */
    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }


    /**
     * @param string $qr
     * @return JsonResponse
     */
    public function getScan(string $qr)
    {
        $code = $this->couponRepository->getByQr($qr);

        if ($code === null) {
            return new JsonResponse('404 : Coupon not found.','404');
        }

        return new JsonResponse($code,200);
    }
}
