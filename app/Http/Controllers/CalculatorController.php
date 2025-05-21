<?php

namespace App\Http\Controllers;

use App\Helpers\CalculatorHelper;
use App\Helpers\PrimeNumberHelper;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator');
    }

    public function calculate(Request $request)
    {
        // Validation Request
        $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
            'operation' => 'required|in:add,subtract',
        ]);

        // Mengambil data
        $a = (int) $request->input('a');
        $b = (int) $request->input('b');
        $operation = $request->input('operation');

        // Validasi bilangan prima
        if (!PrimeNumberHelper::validatePrimeNumbers($a, $b)) {
            return back()
                ->withErrors([
                    'a' => !PrimeNumberHelper::isPrime($a) ? 'Angka pertama harus berupa bilangan prima.' : null,
                    'b' => !PrimeNumberHelper::isPrime($b) ? 'Angka kedua harus berupa bilangan prima.' : null,
                ])
                ->withInput();
        }

        // Menghitung data
        $result = $operation === 'add'
            ? CalculatorHelper::add($a, $b)
            : CalculatorHelper::subtract($a, $b);

        // Return view
        return view('calculator', compact('a', 'b', 'operation', 'result'));
    }
}
