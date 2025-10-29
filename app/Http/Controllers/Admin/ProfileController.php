<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit()
    {
        $locale = app()->getLocale();
        return Inertia::render('Admin/Profile/Edit', [
            'user' => auth()->user(),
            'countries' => Country::orderBy("name->{$locale}", 'desc')->get()
        ]);
    }
}
