<?php

namespace App\Helpers;

class PrimeNumberHelper
{
    /**
     * Memeriksa apakah sebuah angka adalah bilangan prima
     *
     * @param int $number
     * @return bool
     */
    public static function isPrime(int $number): bool
    {
        // Angka negatif, 0, dan 1 bukan bilangan prima
        if ($number <= 1) {
            return false;
        }

        // 2 adalah bilangan prima
        if ($number === 2) {
            return true;
        }

        // Jika angka genap (kecuali 2), bukan bilangan prima
        if ($number % 2 === 0) {
            return false;
        }

        // Cek pembagi dari 3 sampai akar kuadrat dari angka
        for ($i = 3; $i <= sqrt($number); $i += 2) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * Memvalidasi apakah kedua angka adalah bilangan prima
     *
     * @param int $number1
     * @param int $number2
     * @return bool
     */
    public static function validatePrimeNumbers(int $number1, int $number2): bool
    {
        return self::isPrime($number1) && self::isPrime($number2);
    }
} 