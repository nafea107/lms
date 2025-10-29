<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'home',
                'name' => 'home',
                'data' => [
                    'image_1' => [
                        'type' => 'image',
                        'value' => null,
                    ],
                    'image_2' => [
                        'type' => 'image',
                        'value' => null,
                    ]
                ],
            ],

            [
                'slug' => 'instructor',
                'name' => 'instructor',
                'data' => [
                    'photo' => [
                        'type' => 'image',
                        'value' => null,
                    ],
                    'specialization' => [
                        'type' => 'text',
                        'value' => null,
                    ],
                    'career' => [
                        'type' => 'text',
                        'value' => null,
                    ],
                    'slogan' => [
                        'type' => 'text',
                        'value' => null,
                    ],
                ],
            ]
        ];
        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
