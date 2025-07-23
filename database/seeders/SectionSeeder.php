<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\ThemeService;

class SectionSeeder extends Seeder
{
    private ThemeService $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->themeService->addHero();
        $this->themeService->addStory();
        $this->themeService->addBlocks();
        $this->themeService->addPartners();
        $this->themeService->addTestimonials();
        $this->themeService->addPricing();
        $this->themeService->addFooter();
    }
}
