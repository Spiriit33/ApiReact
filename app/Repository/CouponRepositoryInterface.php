<?php


namespace App\Repository;


interface CouponRepositoryInterface extends BaseRepositoryInterface
{
    public function generateQrCode(string $code,string $image);

    public function getByQr(string $code);
}
