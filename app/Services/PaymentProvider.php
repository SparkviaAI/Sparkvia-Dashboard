<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\StripeSubscription;
use App\Models\User;
use Laravel\Cashier\Checkout;

interface PaymentProvider
{
    public function cancelSubscription(StripeSubscription $subscription): ?StripeSubscription;

    /**
     * @throws \App\Exceptions\SubscriptionCreationFailedException
     */
    public function newSubscription(
        User $user,
        string $title,
        string $planId,
        bool $onetime,
        string $url = ''
    ): Checkout|string;
}
