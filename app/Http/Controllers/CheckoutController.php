<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartManager;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cart = app(CartManager::class);
        return view('checkout', [
            'cart' => $cart
        ]);
    }
}
