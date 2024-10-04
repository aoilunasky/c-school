<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        if (in_array($locale, ['en', 'jp'])) {
            App::setlocale($locale);
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
