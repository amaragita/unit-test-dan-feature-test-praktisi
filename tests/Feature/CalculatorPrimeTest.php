<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculatorPrimeTest extends TestCase
{
    /**
     * Test untuk memastikan kalkulator hanya menerima bilangan prima
     * untuk operasi penjumlahan dan pengurangan
     */
    public function test_calculator_only_accepts_prime_numbers()
    {
        // Test case untuk penjumlahan
        $response = $this->post('/calculator', [
            'a' => 2,  // bilangan prima
            'b' => 3,  // bilangan prima
            'operation' => 'add'
        ]);
        $response->assertStatus(200);
        $response->assertSee('5'); // 2 + 3 = 5

        // Test case untuk pengurangan
        $response = $this->post('/calculator', [
            'a' => 7,  // bilangan prima
            'b' => 5,  // bilangan prima
            'operation' => 'subtract'
        ]);
        $response->assertStatus(200);
        $response->assertSee('2'); // 7 - 5 = 2

        // Test case untuk input non-prima
        $response = $this->post('/calculator', [
            'a' => 4,  // bukan bilangan prima
            'b' => 3,  // bilangan prima
            'operation' => 'add'
        ]);
        $response->assertStatus(302); // Redirect back
        $response->assertSessionHasErrors('a');

        // Test case untuk input non-prima kedua
        $response = $this->post('/calculator', [
            'a' => 2,  // bilangan prima
            'b' => 6,  // bukan bilangan prima
            'operation' => 'subtract'
        ]);
        $response->assertStatus(302); // Redirect back
        $response->assertSessionHasErrors('b');
    }

    /**
     * Test untuk memastikan validasi pesan error yang tepat
     */
    public function test_calculator_shows_proper_error_messages()
    {
        $response = $this->post('/calculator', [
            'a' => 4,
            'b' => 6,
            'operation' => 'add'
        ]);
        
        $response->assertStatus(302); // Redirect back
        $response->assertSessionHasErrors([
            'a' => 'Angka pertama harus berupa bilangan prima.',
            'b' => 'Angka kedua harus berupa bilangan prima.'
        ]);
    }
}
