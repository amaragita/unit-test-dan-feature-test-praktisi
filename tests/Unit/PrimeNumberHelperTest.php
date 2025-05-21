<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\PrimeNumberHelper;

class PrimeNumberHelperTest extends TestCase
{
    /**
     * Test untuk memastikan fungsi isPrime mengembalikan true untuk bilangan prima
     */
    public function test_is_prime_returns_true_for_prime_numbers()
    {
        $primeNumbers = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29];
        
        foreach ($primeNumbers as $number) {
            $this->assertTrue(
                PrimeNumberHelper::isPrime($number),
                "{$number} seharusnya diidentifikasi sebagai bilangan prima"
            );
        }
    }

    /**
     * Test untuk memastikan fungsi isPrime mengembalikan false untuk bilangan non-prima
     */
    public function test_is_prime_returns_false_for_non_prime_numbers()
    {
        $nonPrimeNumbers = [1, 4, 6, 8, 9, 10, 12, 14, 15, 16];
        
        foreach ($nonPrimeNumbers as $number) {
            $this->assertFalse(
                PrimeNumberHelper::isPrime($number),
                "{$number} seharusnya diidentifikasi sebagai bukan bilangan prima"
            );
        }
    }

    /**
     * Test untuk memastikan fungsi isPrime menangani angka negatif dengan benar
     */
    public function test_is_prime_handles_negative_numbers()
    {
        $this->assertFalse(PrimeNumberHelper::isPrime(-1));
        $this->assertFalse(PrimeNumberHelper::isPrime(-2));
        $this->assertFalse(PrimeNumberHelper::isPrime(-3));
    }

    /**
     * Test untuk memastikan fungsi isPrime menangani angka 0 dan 1 dengan benar
     */
    public function test_is_prime_handles_zero_and_one()
    {
        $this->assertFalse(PrimeNumberHelper::isPrime(0));
        $this->assertFalse(PrimeNumberHelper::isPrime(1));
    }

    /**
     * Test untuk memastikan fungsi validatePrimeNumbers mengembalikan true untuk dua bilangan prima
     */
    public function test_validate_prime_numbers_returns_true_for_two_prime_numbers()
    {
        $this->assertTrue(PrimeNumberHelper::validatePrimeNumbers(2, 3));
        $this->assertTrue(PrimeNumberHelper::validatePrimeNumbers(5, 7));
        $this->assertTrue(PrimeNumberHelper::validatePrimeNumbers(11, 13));
    }

    /**
     * Test untuk memastikan fungsi validatePrimeNumbers mengembalikan false untuk kombinasi non-prima
     */
    public function test_validate_prime_numbers_returns_false_for_non_prime_combinations()
    {
        $this->assertFalse(PrimeNumberHelper::validatePrimeNumbers(2, 4));
        $this->assertFalse(PrimeNumberHelper::validatePrimeNumbers(4, 3));
        $this->assertFalse(PrimeNumberHelper::validatePrimeNumbers(6, 8));
    }
} 