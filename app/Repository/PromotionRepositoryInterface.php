<?php


namespace App\Repository;


use Illuminate\Support\Collection;

interface PromotionRepositoryInterface extends BaseRepositoryInterface
{
    public function getFeatured() : Collection;
}
