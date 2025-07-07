<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    public function index(): View
    {
        return view('app.frontend.pages.about-us.index');
    }
}
