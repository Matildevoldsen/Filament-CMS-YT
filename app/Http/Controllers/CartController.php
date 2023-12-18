<?php

namespace App\Http\Controllers;

use App\Services\CartManager;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cart = app(CartManager::class);
        return view('cart', [
            'cart' => $cart
        ]);
    }
}
