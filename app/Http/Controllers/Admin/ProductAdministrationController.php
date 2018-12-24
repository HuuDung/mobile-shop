<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestValue;
use App\Http\Requests\UploadImageRequest;
use App\Models\Category;
use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductAdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id','desc')->paginate(5);
        $categories = Category::all();
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [

            'products' => $product,
            'categories' => $categories,
            'title' => "Product Administration",
            'cart' => $cart,
        ];
        return view('admin.product-administration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'title' => "Create Product",
            'categories' => $categories,
            'cart' => $cart,
        ];
        return view('admin.product-administration.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        //
        $id = Product::withTrashed()->count() + 1;
        $product = new Product();
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $type = $request->file('image')->getClientOriginalExtension();
            $url = 'products/images/' . $id . '/' . $filename;

            $image = Image::make($request->file('image'))->resize(150, 150)->encode($type);
            Storage::disk('s3')->put($url, (string)$image, 'public');


            $product->fill([
                'image' => $url,
            ]);
        }
        $product->fill([
            'name' => $request->name,
            'cost' => $request->cost,
            'category_id' => $request->category,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);
        $product->save();
        return redirect()->route('admin.product-administration.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::findOrFail($id);
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'title' => "Show product",
            'product' => $product,
            'cart' => $cart,
        ];
        return view('admin.product-administration.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }
        $data = [
            'product' => $product,
            'categories' => $categories,
            'title' => "Edit Product",
            'cart' => $cart,
        ];
        return view('admin.product-administration.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadImageRequest $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName();
            $type = $request->file('image')->getClientOriginalExtension();
            $url = 'products/images/' . $product->id . '/' . $filename;

            $image = Image::make($request->file('image'))->resize(150, 150)->encode($type);
            Storage::disk('s3')->put($url, (string)$image, 'public');

            $product->update([
                'image' => $url,
            ]);
        }
        $product->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'category_id' => $request->category,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);
        $product->save();
        return redirect()->route('admin.product-administration.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product-administration.index');
    }

    public function search(RequestValue $request)
    {
        $categories = Category::all();

        $category = $request->category;
        $costMin = $request->costMin;
        $costMax = $request->costMax;
        $content = $request->content;

        $cart = 0;
        if (session()->has('product')) {
            $data = session()->get('product');
            foreach ($data as $key => $value) {
                $cart += $value['quantity'];
            }
        }

        $products = Product::where('cost', '>', 0);
        if ($costMin != null) {
            $products = $products->where('cost', '>=', $request->costMin);
        }

        if ($costMax != null) {
            $products = $products->where('cost', '<=', $request->costMax);
        }

        if ($category != null) {
            $products = $products->where('category_id', $request->category);
        }

        if ($content != null) {
            $products = $products->where('id', 'like', '%' . $content . '%')
                ->orWhere('name', 'like', '%' . $content . '%');
        }
        $products = $products->paginate(5);
        $data = [

            'products' => $products,
            'categories' => $categories,
            'title' => "Product Administration",
            'cart' => $cart,
            'filterParams' => [
                'content' => $content,
                'costMin' => $costMin,
                'costMax' => $costMax,
                'category' => $category,
            ]
        ];
        return view('admin.product-administration.index', $data);
    }
}
