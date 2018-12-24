<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestValue;
use App\Models\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(12);
        $categories = Category::all();
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'products' => $products,
            'categories' => $categories,
            'title' => "Home",
            'cart' => $cart,
        ];
        return view('home', $data);
    }


    public function search(Request $request)
    {
        $categories = Category::all();
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        if ($request->category != null) {
            $products = Product::where('category_id', $request->category)
                ->where('name', 'like', '%' . $request->content . '%')->orderBy('id','desc')
                ->paginate(12);
        } else {
            $products = Product::where('name', 'like', '%' . $request->content . '%')->orderBy('id','desc')
                ->paginate(12);
        }
        if ($products->count() == 0) {
            $data = [
                'products' => $products,
                'status' => false,
                'title' => "Result",
                'categories' => $categories,
                'cart' => $cart,
            ];
        } else {
            $data = [
                'products' => $products,
                'status' => true,
                'title' => "Result",
                'categories' => $categories,
                'cart' => $cart,
            ];
        }
        return view('home', $data);
    }

    public function searchFilter(RequestValue $request)
    {
        $costMin = $request->costMin;
        $costMax = $request->costMax;
        $category = $request->category;
        if ($costMax != null || $costMin != null || $category != null) {
            $products = Product::where('cost', '>', 0);
            if ($costMin != null) {
                $products =$products->where('cost', '>=', $costMin);
            }
            if ($costMax != null) {
                $products =$products->where('cost', '<=', $costMax);
            }
            if ($category != null) {
                $products =$products->where('category_id', $category);
            }
            $products=$products->orderBy('id','desc');
            $products = $products->paginate(12);
            $categories = Category::all();
            $cart = 0;
            if (session()->has('product')) {
                $data = session()->get('product');
                foreach ($data as $key => $value) {
                    $cart += $value['quantity'];
                }
            }
            $data = [
                'products' => $products,
                'categories' => $categories,
                'title' => "Home",
                'cart' => $cart,
                'filterParams'=>[
                    'costMin' => $costMin,
                    'costMax' => $costMax,
                    'category' => $category,
                ],
            ];
            return view('home', $data);
        } else {
            return redirect()->route('home');
        }
    }
}
