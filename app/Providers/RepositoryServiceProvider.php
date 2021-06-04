<?php

namespace App\Providers;

use App\Repository\BaseRepository;
use App\Repository\BaseRepositoryInterface;
use App\Repository\CouponRepository;
use App\Repository\CouponRepositoryInterface;
use App\Repository\PromotionRepository;
use App\Repository\PromotionRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class,PromotionRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CouponRepositoryInterface::class,CouponRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
