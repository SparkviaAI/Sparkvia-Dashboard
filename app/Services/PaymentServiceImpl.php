<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\StripeSubscription;
use App\Repository\Payment\SubscriptionRepository;
use Stripe\Subscription;

final class PaymentServiceImpl implements PaymentService
{
    public function __construct(private readonly SubscriptionRepository $subscriptionRepository)
    {
    }

    public function getUsedWordsCount(StripeSubscription $subscription): float
    {
        return $subscription->plan->word_limit ?
            min($subscription->usage, $subscription->plan->word_limit) : $subscription->usage;
    }

    public function getUsedWordsPercentage(StripeSubscription $subscription): float
    {
        return $subscription->plan->word_limit ?
         ($this->getUsedWordsCount($subscription) / ($subscription->plan->word_limit ?? 1)) * 100 : 10;
    }

    public function getUsedImagesCount(StripeSubscription $subscription): float
    {
        return $subscription->plan->image_limit ?
            min($subscription->image_usage, $subscription->plan->image_limit) : $subscription->image_usage;
    }

    public function getUsedImagesPercentage(StripeSubscription $subscription): float
    {
        return $subscription->plan->image_limit ?
            ($this->getUsedImagesCount($subscription) / ($subscription->plan->image_limit ?? 1)) * 100 : 10;
    }

    public function getSubscriptionStatistics(StripeSubscription $subscription): array
    {
        return [
            $this->getUsedWordsCount($subscription),
            $this->getUsedWordsPercentage($subscription),
            $this->getUsedImagesCount($subscription),
            $this->getUsedImagesPercentage($subscription),
        ];
    }

    /**
     * @throws \App\Exceptions\SubscriptionCancellationException
     */
    public function cancelStaleSubscription(StripeSubscription $subscription): ?StripeSubscription
    {
        if (in_array($subscription->stripe_status, [Subscription::STATUS_CANCELED, Subscription::STATUS_PAST_DUE])) {
            return null;
        }

        return (new StripePaymentProvider())->cancelSubscription($subscription);
    }

    public function createSubscription(array $data): StripeSubscription
    {
        return $this->subscriptionRepository->store($data);
    }

    public function findById(int $id): StripeSubscription
    {
        return $this->subscriptionRepository->find($id);
    }
}
