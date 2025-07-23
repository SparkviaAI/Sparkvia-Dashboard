<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\StripeSubscription;

interface PaymentService
{
    public function getUsedWordsCount(StripeSubscription $subscription): float;

    public function getUsedImagesCount(StripeSubscription $subscription): float;

    public function getUsedWordsPercentage(StripeSubscription $subscription): float;

    public function getUsedImagesPercentage(StripeSubscription $subscription): float;

    public function getSubscriptionStatistics(StripeSubscription $subscription): array;

    public function cancelStaleSubscription(StripeSubscription $subscription): ?StripeSubscription;

    public function createSubscription(array $data): StripeSubscription;

    public function findById(int $id): StripeSubscription;
}
