<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeSearchRequest;
use App\Http\Requests\ShopRequest;
use Illuminate\Http\Request;
use App\Shop;
use App\Region;
use App\Services\SequenceService;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(CodeSearchRequest $request)
    {
        $shops = Shop::withCount('stocks')
            ->codeSearch($request->code)
            ->keywordSearch($request->keyword)
            ->statusSearch($request->is_active)
            ->paginate(10);

        if($request->ajax()) {
            if($shops->isEmpty()) {
                return '';
            }
            return view('shops.partials.list', compact('shops'))
                ->render();
        }

        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        $regions = Region::all();
        $shop = new Shop();

        return view('shops.create', compact('regions','shop'));
    }

    public function store(ShopRequest $request)
    {
        $data = $request->validated();

        $region = Region::findOrFail($data['prefecture']);

        DB::transaction(function () use ($data, $region) {
            $nextCode = SequenceService::next('shop_code');

            $data['region_id'] = $region->id;
            $data['prefecture'] = $region->name;
            $data['code'] = $nextCode;

            Shop::create($data);
        });

        return redirect()
            ->route('shops.index')
            ->with('success', __('messages.shop_created'));
    }

    public function edit(Shop $shop)
    {
        $shop->load('region');
        $regions = Region::all();

        return view('shops.edit', compact('shop', 'regions'));
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        $data = $request->validated();

        $region = Region::findOrFail($data['prefecture']);
        
        $data['prefecture'] = $region->name;

        $shop->update($data);

        return redirect()
            ->route('shops.index')
            ->with('success', __('messages.shop_info_updated', ['name' => $shop->name ]));
    }

    public function toggle(Shop $shop)
    {
        $shop->update([
            'is_active' => $shop->is_active ? false : true,
        ]);

        return redirect()
            ->route('shops.index')
            ->with('success', __('messages.shop_status_updated', ['name' => $shop->name]));
    }
}
