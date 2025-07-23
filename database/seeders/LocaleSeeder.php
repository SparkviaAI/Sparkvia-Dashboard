<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locale;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = [
            [
                'id' => 1,
                'title' => 'English',
                'slug' => 'en',
                'flag_name' => 'flag_us.svg',
                'created_by' => 1,
            ],[
                'id' => 2,
                'title' => 'Spanish',
                'slug' => 'es',
                'flag_name' => 'flag_es.svg',
                'created_by' => 1,
            ],[
                'id' => 3,
                'title' => 'French',
                'slug' => 'fr',
                'flag_name' => 'flag_fr.svg',
                'created_by' => 1,
            ],[
                'id' => 4,
                'title' => 'Italian',
                'slug' => 'it',
                'flag_name' => 'flag_it.svg',
                'created_by' => 1,
            ],[
                'id' => 5,
                'title' => 'Dutch',
                'slug' => 'nl',
                'flag_name' => 'flag_nl.svg',
                'created_by' => 1,
            ],[
                'id' => 6,
                'title' => 'Portuguese',
                'slug' => 'pt',
                'flag_name' => 'flag_pt.svg',
                'created_by' => 1,
            ],

        ];

        foreach ($locales as $row) {
            Locale::create($row);
        }
    }
}
