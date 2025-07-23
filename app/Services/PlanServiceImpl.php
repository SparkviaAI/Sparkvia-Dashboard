<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Plan;
use App\Repository\Payment\PlanRepository;
use Illuminate\Support\Collection;

final class PlanServiceImpl implements PlanService
{
    /**
     * @var \App\Repository\Payment\PlanRepository
     */
    private PlanRepository $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function findById(int $planId): Plan
    {
        return $this->planRepository->find($planId);
    }

    public function planByPayPalId(string $paypalPlanId): ?Plan
    {
        return $this->planRepository->planByPayPalId($paypalPlanId);
    }

    public function getAllPlans(): Collection
    {
        return $this->planRepository->all();
    }

    public function createPlan(array $data): Plan
    {
        return $this->planRepository->store($data);
    }

    public function updatePlan(int $planId, array $data): Plan
    {
        return $this->planRepository->updateWhere(['id' => $planId], $data, true);
    }

    public function deletePlan(int $id): bool
    {
        return $this->delete($id);
    }

    public function deletePlans(array $ids): bool
    {
        return $this->delete($ids);
    }

    /**
     * @param array|int $ids
     * @return bool
     */
    private function delete(array|int $ids): bool
    {
        try {
            $this->planRepository->deleteBy('id', $ids);
            return true;
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }
}
