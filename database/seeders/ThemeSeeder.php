<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'panel' => 'Home Page',
                'theme' => 'light',
            ],
            [
                'panel' => 'User Panel',
                'theme' => 'light',
            ]
        ];
        foreach ($themes as $theme) {
            Theme::insert($theme);
        }
    }
}
