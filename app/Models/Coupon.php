<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relation 1:N with coupon_qrs table.
     * @return HasMany
     */
    public function QrCodes(): HasMany
    {
        return $this->hasMany(CouponQr::class, 'coupon_code');
    }

    /**
     * Get latest QrCode for current coupon.
     * @return HasMany
     */
    public function getQr(): HasMany
    {
        return $this->QrCodes()->latest();
    }
}
