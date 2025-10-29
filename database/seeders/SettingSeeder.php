<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'app_name',
                'value' => null,
            ],
            [
                'key' => 'logo',
                'value' => null,
            ],
            [
                'key' => 'facebook',
                'value' => null,
            ],
            [
                'key' => 'instagram',
                'value' => null,
            ],
            [
                'key' => 'whatsapp',
                'value' => null,
            ],
            [
                'key' => 'email',
                'value' => null,
            ],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
