<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Discount;

class DiscountCalculationTest extends TestCase
{
    public function test_calculates_discount_correctly()
    {
        $discount = new Discount([
            'min_purchase' => 100000,
            'discount_percentage' => 10
        ]);

        $this->assertEquals(15000, $discount->calculateDiscount(150000));
    }

    public function test_returns_zero_for_amount_below_minimum()
    {
        $discount = new Discount([
            'min_purchase' => 100000,
            'discount_percentage' => 10
        ]);

        $this->assertEquals(0, $discount->calculateDiscount(50000));
    }

    public function test_handles_edge_case_at_minimum_amount()
    {
        $discount = new Discount([
            'min_purchase' => 100000,
            'discount_percentage' => 10
        ]);

        $this->assertEquals(10000, $discount->calculateDiscount(100000));
    }

    public function test_handles_decimal_amounts()
    {
        $discount = new Discount([
            'min_purchase' => 100000,
            'discount_percentage' => 10
        ]);

        $this->assertEquals(15000.50, $discount->calculateDiscount(150005));
    }
} 