<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\Theme\ThemeRepository;

class ThemeServiceImpl implements ThemeService
{
    /**
     * @var ThemeRepository
     */
    private $themeRepository;

    /**
     * @param ThemeRepository $themeRepository
     */
    public function __construct(
        ThemeRepository $themeRepository
    ) {
        $this->themeRepository = $themeRepository;
    }

    /**
     * Add Default Hero Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addHero($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addHero($page_id, $tenant_id);
    }

    /**
     * Add Default Partners Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addPartners($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addPartners($page_id, $tenant_id);
    }

    /**
     * Add Default Blocks Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addBlocks($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addBlocks($page_id, $tenant_id);
    }

    /**
     * Add Default Story Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addStory($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addStory($page_id, $tenant_id);
    }

    /**
     * Add Default Pricing Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addPricing($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addPricing($page_id, $tenant_id);
    }

    /**
     * Add Default Testimonials Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addTestimonials($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addTestimonials($page_id, $tenant_id);
    }

    /**
     * Add Default Footer Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addFooter($page_id = null, $tenant_id = null): int
    {
        return $this->themeRepository->addFooter($page_id, $tenant_id);
    }

    public function beginTransaction(): void
    {
        $this->themeRepository->beginTransaction();
    }

    public function commit(): void
    {
        $this->themeRepository->commit();
    }

    public function rollback(): void
    {
        $this->themeRepository->rollback();
    }
}
