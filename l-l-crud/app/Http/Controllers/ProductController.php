<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(): View
    {
        $products = Product::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }
}
