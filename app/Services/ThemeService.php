<?php

declare(strict_types=1);

namespace App\Services;

interface ThemeService
{
    /**
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addHero($page_id = null, $tenant_id = null): int;

    /**
     * Add Default Partners Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addPartners($page_id = null, $tenant_id = null): int;

    /**
     * Add Default Blocks( Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addBlocks($page_id = null, $tenant_id = null): int;

    /**
     * Add Default Story Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addStory($page_id = null, $tenant_id = null): int;

    /**
     * Add Default Pricing Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addPricing($page_id = null, $tenant_id = null): int;

    /**
     * Add Default Testimonials Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addTestimonials($page_id = null, $tenant_id = null): int;

    /**
     * Add Default Footer Section with its components
     * @param $page_id
     * @param $tenant_id
     * @return int
     */
    public function addFooter($page_id = null, $tenant_id = null): int;

    public function beginTransaction(): void;

    public function rollback(): void;

    public function commit(): void;
}
