<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shop;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(Request $request) {
        $staffs = User::with('shop')
            ->keywordSearch($request->input('keyword'))
            ->roleSearch($request->input('role'))
            ->isActiveSearch($request->input('is_active'))
            ->paginate(10);

        return view('staff.index', compact('staffs'));
    }

    public function create() {
        $shops = Shop::all();

        return view('staff.create', compact('shops'));
    }

    public function store(StoreStaffRequest $request) {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('staff.index')
            ->with('success', 'スタッフを登録しました');
    }

    public function edit(User $user) {
        $staff = $user;
        $shops = Shop::all();
        return view('staff.edit', compact('staff', 'shops'));
    }

    public function update(UpdateStaffRequest $request, User $user) {
        $user->update($request->validated());

        return redirect()
            ->route('staff.index')
            ->with('success', __('messages.staff_info_updated', ['name' => $user->name]));
    }

    public function toggle(User $user) {
        $this->authorize('toggle', $user);

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', __('messages.staff_status_updated', ['name' => $user->name]));
    }
}
