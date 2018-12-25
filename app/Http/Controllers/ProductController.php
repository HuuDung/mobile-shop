<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    //
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $data = [
            'product' => $product,
            'title' => 'Product Detail',
        ];
        return view('product.show', $data);
    }
}
