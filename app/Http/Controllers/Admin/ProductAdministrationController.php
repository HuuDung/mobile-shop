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
        $product = Product::withTrashed()->orderBy('id', 'desc')->paginate(12);
        $data = [

            'products' => $product,
            'title' => "Product Administration",
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
        $data = [
            'title' => "Create Product",
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

            $image = Image::make($request->file('image'))->resize(400, 400)->encode($type);
            Storage::disk('s3')->put($url, (string)$image, 'public');


            $product->fill([
                'image' => $url,
            ]);
        }
        $product->fill([
            'name' => $request->name,
            'cost' => $request->cost,
            'category_id' => $request->category,
            'system_id' => $request->system,
            'ram_id' => $request->ram,
            'storage_id' => $request->storage,
            'cpu_id' => $request->cpu,
            'weight' => (float)$request->weight,
            'screen_size' => (float)$request->screenSize,
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
        $data = [
            'title' => "Show product",
            'product' => $product,
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
        $data = [
            'product' => $product,
            'title' => "Edit Product",
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

            $image = Image::make($request->file('image'))->resize(400, 400)->encode($type);
            Storage::disk('s3')->put($url, (string)$image, 'public');

            $product->update([
                'image' => $url,
            ]);
        }
        $product->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'category_id' => $request->category,
            'system_id' => $request->system,
            'ram_id' => $request->ram,
            'storage_id' => $request->storage,
            'cpu_id' => $request->cpu,
            'weight' => (float)$request->weight,
            'screen_size' => (float)$request->screenSize,
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

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('admin.product-administration.index');
    }

    public function search(RequestValue $request)
    {
        $category = $request->category;
        $costMin = $request->costMin;
        $costMax = $request->costMax;
        $content = $request->content;
        $ram = $request->ram;
        $system = $request->system;
        $cpu = $request->cpu;
        $storage = $request->storage;

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
        if ($ram != null) {
            $products = $products->where('ram_id', $ram);
        }
        if ($storage != null) {
            $products = $products->where('storage_id', $storage);
        }
        if ($system != null) {
            $products = $products->where('system_id', $system);
        }
        if ($cpu != null) {
            $products = $products->where('cpu_id', $cpu);
        }
        $products = $products->paginate(12);
        $data = [

            'products' => $products,
            'title' => "Product Administration",
            'filterParams' => [
                'content' => $content,
                'costMin' => $costMin,
                'costMax' => $costMax,
                'category' => $category,
                'ram' => $ram,
                'cpu' => $cpu,
                'storage' => $storage,
                'system' => $system,
            ]
        ];
        return view('admin.product-administration.index', $data);
    }
}
