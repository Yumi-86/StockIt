<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Services\SequenceService;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->keywordSearch($request->keyword)
            ->categorySearch($request->category_id)
            ->statusSearch($request->is_active)
            ->paginate(10);

        return view('products.index', compact('categories','products'));
    }

    public function create() {
        $categories = Category::all();
        $product = new Product();

        return view('products.create', compact('categories', 'product'));
    }

    public function store(ProductRequest $request) {
        $data = $request->validated();

        if($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')
                ->store('uploads', 'public');
        }

        $category = Category::findOrFail($data['category_id']);

        DB::transaction(function () use ($category, $data) {
            $nextCode = SequenceService::next('product_code');

            Product::create([
                'code' => $nextCode,
                'code_prefix' => $category->prefix,
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'weight' => $data['weight'],
                'image_path' => $data['image_path'] ?? null,
            ]);
        });

        return redirect()
            ->route('products.index')
            ->with('success', '商品を登録しました');
    }

    public function edit(Product $product) {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product) {
        $data = $request->validated();

        if($request->hasFile('image_path')) {
            if($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $path = $request->file('image_path')
                ->store('uploads', 'public');
        } else {
            $path = $product->image_path;
        }

        $data['code'] = $product->code;
        $data['code_prefix'] = $product->code_prefix;
        $data['image_path'] = $path;

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', __('messages.product_info_updated', ['name' => $product->name]));
    }

    public function toggle(Product $product)
    {
        $product->update([
            'is_active' => $product->is_active ? false : true,
        ]);

        return redirect()->route('products.index')
            ->with('success', __('messages.product_status_updated', ['name' => $product->name]));
    }
}
