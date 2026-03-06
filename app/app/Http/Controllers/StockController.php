<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CodeSearchRequest;
use Illuminate\Http\Request;
use App\Stock;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    public function all(CodeSearchRequest $request)
    {

        $query = Stock::with(['product.category', 'shop']);

        $stocks = $query->codeSearch($request->code)
            ->keywordSearch($request->keyword)
            ->categorySearch($request->category_id)
            ->paginate(10);

        $categories = Category::all();

        if ($request->ajax()) {
            if ($stocks->isEmpty()) {
                return '';
            }
            return view('stocks.partials.list', [
                'stocks' => $stocks,
                'mode' => 'all'
            ])->render();
        }

        return view('stocks.index', [
            'stocks' => $stocks,
            'categories' => $categories,
            'mode' => 'all'
        ]);
    }

    public function myShop(CodeSearchRequest $request)
    {
        $user = Auth::user();

        $query = Stock::with('product.category');

        $query->where('shop_id', $user->shop_id);

        $stocks = $query->codeSearch($request->code)
            ->keywordSearch($request->keyword)
            ->categorySearch($request->category_id)
            ->paginate(10);

        $categories = Category::all();

        if ($request->ajax()) {
            if ($stocks->isEmpty()) {
                return '';
            }
            return view('stocks.partials.list', [
                'stocks' => $stocks,
                'mode' => 'my'
            ])->render();
        }

        return view('stocks.index', [
            'stocks' => $stocks,
            'categories' => $categories,
            'mode' => 'my'
        ]);
    }

    public function edit(Stock $stock) {
        $stock->load('product', 'shop');

        return view('stocks.edit', compact('stock'));
    }

    public function update(StockRequest $request, Stock $stock)
    {
        $data = $request->validated();

        $stock->decrement('quantity', $data['quantity']);
        
        return redirect()->route('stocks.my')
            ->with('success', __('messages.stock_adjusted', [
                'code' => $stock->display_product_code,
                'name' => $stock->product->name,
                'quantity' => $request->quantity,
            ]));
    }
}
