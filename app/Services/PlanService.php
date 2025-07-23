<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Collection;

interface PlanService
{
    public function getAllPlans(): Collection;

    public function updatePlan(int $planId, array $data): Plan;

    public function findById(int $planId): Plan;

    public function planByPayPalId(string $paypalPlanId): ?Plan;

    public function createPlan(array $data): Plan;

    public function deletePlan(int $id): bool;

    public function deletePlans(array $ids): bool;
}
