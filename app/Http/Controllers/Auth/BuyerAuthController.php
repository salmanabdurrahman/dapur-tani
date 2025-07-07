<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyerAuthController extends Controller
{
    public function create(Request $request)
    {
        $openTab = in_array($request->query('o'), ['login', 'register']) ? $request->query('o') : 'login';
        $title = ($openTab === 'register')
            ? 'Buat Akun Baru - Dapur Tani'
            : 'Masuk ke Akun Anda - Dapur Tani';

        return view('app.frontend.pages.auth.create', compact('openTab', 'title'));
    }
}
