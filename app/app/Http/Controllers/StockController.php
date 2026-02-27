<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Stock;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Stock::with(['product.category', 'shop']);

        if(!$user->isAdmin()) {
            $query->where('shop_id', $user->shop_id);
        }
        
        $stocks = $query->keywordSearch($request->keyword)
            ->categorySearch($request->category_id)
            ->paginate(10);

        $categories = Category::all();

        return view('stocks.index', compact('stocks', 'categories'));
    }

    public function edit(Stock $stock) {
        $stock->load('product', 'shop');

        return view('stocks.edit', compact('stock'));
    }

    public function update(StockRequest $request, Stock $stock)
    {
        $data = $request->validated();

        $stock->decrement('quantity', $data['quantity']);
        
        return redirect()->route('stocks.index')
            ->with('success', __('messages.stock_adjusted', [
                'code' => $stock->display_product_code,
                'name' => $stock->product->name,
                'quantity' => $request->quantity,
            ]));
    }
}
