<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => [
                    'ar' => 'الفيزياء',
                    'ku' => 'فیزیا'
                ],
                'background' => '#6b46c1', // Purple
                'image' => null // Will be added manually or through admin panel
            ],
            [
                'name' => [
                    'ar' => 'الرياضيات',
                    'ku' => 'بیرکاری'
                ],
                'background' => '#2563eb', // Blue
                'image' => null
            ],
            [
                'name' => [
                    'ar' => 'العلوم',
                    'ku' => 'زانست'
                ],
                'background' => '#ea580c', // Orange
                'image' => null
            ],
            [
                'name' => [
                    'ar' => 'الكيمياء',
                    'ku' => 'کیمیا'
                ],
                'background' => '#dc2626', // Red
                'image' => null
            ],
            [
                'name' => [
                    'ar' => 'الأحياء',
                    'ku' => 'زیندەوەرزانی'
                ],
                'background' => '#059669', // Green
                'image' => null
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
