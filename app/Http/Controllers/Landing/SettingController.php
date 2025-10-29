<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __invoke($locale, $keys)
    {
        $keys = explode(',', $keys);
        return Setting::whereIn('key', $keys)->get(['value', 'key'])->pluck('value', 'key');

    }
}
