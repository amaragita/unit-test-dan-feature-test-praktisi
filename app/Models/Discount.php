<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_purchase',
        'discount_percentage',
        'is_active'
    ];

    protected $casts = [
        'min_purchase' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function calculateDiscount($amount)
    {
        if ($amount < $this->min_purchase) {
            return 0;
        }

        return ($amount * $this->discount_percentage) / 100;
    }
}
