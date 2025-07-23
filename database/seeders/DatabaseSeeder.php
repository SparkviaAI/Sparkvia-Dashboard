<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CurrencySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PermissionRolesSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(EngineSeeder::class);
        $this->call(PromptSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(LocaleSeeder::class);
        $this->call(PromptQuestionSeeder::class);
       
    }
}
