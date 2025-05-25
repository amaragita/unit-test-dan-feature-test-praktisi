<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        return view('discount.index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'discount_percentage' => 'required|numeric|min:0|max:100'
        ]);

        $originalAmount = (float) $request->amount;
        $discountPercentage = $request->discount_percentage;
        $discountAmount = ($originalAmount * $discountPercentage) / 100;
        $finalAmount = $originalAmount - $discountAmount;

        return view('discount.result', [
            'originalAmount' => $originalAmount,
            'discountAmount' => $discountAmount,
            'finalAmount' => $finalAmount,
            'discountPercentage' => $discountPercentage
        ]);
    }
}
