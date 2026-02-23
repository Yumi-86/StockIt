<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomingPlan;
use App\Category;
use App\Product;
use App\Http\Requests\IncomingPlanRequest;
use Illuminate\Support\Facades\Auth;
use App\Stock;
use Illuminate\Support\Facades\DB;

class IncomingPlanController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $shopId = Auth::user()->shop_id;

        $incomingPlans = IncomingPlan::byShop($shopId)
            ->keywordSearch($request->keyword)
            ->categorySearch($request->category_id)
            ->dateSearch($request->arriving_date)
            ->paginate(10);

        return view('incomings.index', compact('incomingPlans', 'categories'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)
            ->get();

        $incomingPlan = new IncomingPlan();

        return view('incomings.create', compact('products', 'incomingPlan'));
    }

    public function store(IncomingPlanRequest $request) {
        $data = $request->validated();

        $data['shop_id'] = Auth::user()->shop_id;

        IncomingPlan::create($data);

        return redirect()->route('incomings.index')
            ->with('success', '入荷予定を登録しました');

    }

    public function edit(IncomingPlan $incomingPlan)
    {
        $this->authorize('update', $incomingPlan);

        $incomingPlan->load('product');

        $products = Product::where('is_active', true)
            ->get();

        return view('incomings.edit', compact('products', 'incomingPlan'));
    }

    public function update(IncomingPlanRequest $request, IncomingPlan $incomingPlan)
    {
        $this->authorize('update', $incomingPlan);

        $incomingPlan->update($request->validated());

        return redirect()->route('incomings.index')
            ->with('success', __('messages.incomingPlan_info_updated'));
    }

    public function confirm(IncomingPlan $incomingPlan)
    {
        $this->authorize('update', $incomingPlan);

        if($incomingPlan->status !== IncomingPlan::STATUS_NOT_ARRIVED) {
            abort(404);
        }

        DB::transaction(function () use ($incomingPlan) {
            $stock = Stock::firstOrCreate(
                [
                'product_id' => $incomingPlan->product_id,
                'shop_id' => $incomingPlan->shop_id,
                ],
                [
                    'quantity' => 0,
                ]
            );
            $stock->increment('quantity', $incomingPlan->quantity);

            $incomingPlan->update([
                'status' => IncomingPlan::STATUS_ARRIVED,
            ]);
        });

        return redirect()->route('incomings.index')
            ->with('success', __('messages.incomingPlan_confirmed'));
    }
}
