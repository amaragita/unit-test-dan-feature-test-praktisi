<?php

namespace Tests\Feature;

use Tests\TestCase;

class DiscountTest extends TestCase
{
    public function test_can_view_discount_calculator()
    {
        $response = $this->get(route('discount.index'));
        $response->assertStatus(200);
        $response->assertViewIs('discount.index');
    }

    public function test_can_calculate_discount()
    {
        $response = $this->post(route('discount.calculate'), [
            'amount' => 150000,
            'discount_percentage' => 10
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('discount.result');
        $response->assertViewHas('originalAmount', 150000);
        $response->assertViewHas('discountAmount', 15000);
        $response->assertViewHas('finalAmount', 135000);
    }

    public function test_calculates_zero_discount_for_zero_percentage()
    {
        $response = $this->post(route('discount.calculate'), [
            'amount' => 50000,
            'discount_percentage' => 0
        ]);

        $response->assertStatus(200);
        $response->assertViewHas('discountAmount', 0);
        $response->assertViewHas('finalAmount', 50000);
    }

    public function test_validates_required_fields()
    {
        $response = $this->post(route('discount.calculate'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['amount', 'discount_percentage']);
    }

    public function test_validates_discount_percentage_range()
    {
        $response = $this->post(route('discount.calculate'), [
            'amount' => 100000,
            'discount_percentage' => 101
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('discount_percentage');
    }
} 