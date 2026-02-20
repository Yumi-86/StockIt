<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Stock;
use App\IncomingPlan;
use App\User;
use App\Product;

class DashboardController extends Controller
{

    public function index()
    {
        /** @var \App\User $user */
        $user = auth()->user();

        $today = now()->startOfDay();
        $endOfWeek = now()->addDays(6)->endOfDay();

        $stockTotal = Stock::byShop($user->shop_id)
            ->sum('quantity');

        $todayIncomingCount = IncomingPlan::byShop($user->shop_id)
            ->whereDate('arriving_date', today())
            ->sum('quantity');

        $unconfirmedIncomingCount = IncomingPlan::byShop($user->shop_id)
            ->where('status', 0)
            ->sum('quantity');

        $inOneWeekIncomings = IncomingPlan::byShop($user->shop_id)
            ->whereBetween('arriving_date', [$today, $endOfWeek])
            ->with(['product.category'])
            ->get();

        $data = [
            'user' => $user,
            'stockTotal' => $stockTotal,
            'todayIncomingCount' => $todayIncomingCount,
            'unconfirmedIncomingCount' => $unconfirmedIncomingCount,
            'inOneWeekIncomings' => $inOneWeekIncomings,
        ];

        if ($user->isAdmin()) {

            $data['ownShopStaff'] = User::general()
                ->byShop($user->shop_id)
                ->where('is_active', true)
                ->count();

            $data['allStaff'] = User::general()
                ->where('is_active', true)
                ->count();

            $data['productMasterCount'] = Product::where('is_active', true)
                ->count();
        }

        return view('dashboard.index', $data);
    }


}
