<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function edit()
    {
        return Inertia::render('Admin/Settings/Edit', [
            'settings' => Setting::all()
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if ($key === 'logo') {
                if ($request->hasFile('logo')) {
                    $value = $request->file($key)->store('/uploads', 'public');
                }
            }
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'key' => $key]);
        }

        return to_route('admin.home');
    }
}
