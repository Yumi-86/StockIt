<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function generalIndex() {
        return view('dashboard.general');
    }

    public function adminIndex() {
        return view('dashboard.admin');
    }

    public function index()
{
    $user = auth()->user();

    $commonData = [];

    if ($user->role == 0) {
        $adminData = [];

        return view('dashboard.index', array_merge($commonData, $adminData));
    }

    return view('dashboard.index', $commonData);
}


}
