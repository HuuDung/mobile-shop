<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValue;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        if (session()->has('product')) {
            $product = session()->get('product');
            $data = [
                'title' => 'Cart',
                'products' => $product,
                'status' => true,
            ];
        } else {
            $data = [
                'title' => 'Cart',
                'status' => false,
            ];
        }
        return view('cart', $data);
    }

    public function store(RequestValue $request)
    {
        $exist = 0;
        $id = $request->id;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                if ($key == $id) {
                    $exist = 1;
                }
            }
            if ($exist == 0) {
                $data[] = $request->product[$id];
            } else {
                $data[$id]['quantity'] = $data[$id]['quantity'] + $request->product[$id]['quantity'];
            }
            session()->put('product', $data);
        } else {
            $data = $request->product;
            session()->put('product', $data);
        }

        return redirect()->route('home');
    }

    public function update(RequestValue $request)
    {
        $id = $request->id;
        $data = session()->get('product');
        $data[$id]['quantity'] = $request->product[$id]['quantity'];
        session()->put('product', $data);
        return redirect()->route('cart.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = session()->get('product');
        unset($data[$id]);
        if ($data != null) {
            session()->put('product', $data);
        } else {
            session()->forget('product');
        }
        return redirect()->route('cart.index');
    }
}
