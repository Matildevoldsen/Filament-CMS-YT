<?php

namespace App\Http\Middleware;

use App\Services\CartManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cart = app(CartManager::class);

        if (!$cart->exists()) {
            $cart->create($request->user());
        }

        if ($request->user()) {
            $cart->associateWithUser();
        }

        return $next($request);
    }
}
