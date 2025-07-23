<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\SubscriptionCancellationException;
use App\Exceptions\SubscriptionCreationFailedException;
use App\Models\StripeSubscription;
use App\Models\User;
use Laravel\Cashier\Checkout;
use Throwable;

class StripePaymentProvider implements PaymentProvider
{
    /**
     * @throws \App\Exceptions\SubscriptionCancellationException
     */
    public function cancelSubscription(StripeSubscription $subscription): StripeSubscription
    {
        try {
            $subscription->user->stripe()->subscriptions->cancel($subscription->stripe_id);

            return $subscription;
        } catch (Throwable $e) {
            throw new SubscriptionCancellationException($e->getMessage());
        }
    }

    public function newSubscription(
        User $user,
        string $title,
        string $planId,
        bool $onetime,
        string $url = '',
    ): Checkout|string {
        try {
            if ($onetime) {
                return $user->checkout(
                    [$planId => 1],
                    [
                        'success_url' => $url . '?success=true&session_id={CHECKOUT_SESSION_ID}',
                        'cancel_url' => $url . '?success=false',
                    ]
                );
            }

            return $user
                ->newSubscription($title, $planId)
                ->checkout([
                    'success_url' => $url . '?success=true&session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => $url . '?success=false',
                ]);
        } catch (Throwable $e) {
            throw new SubscriptionCreationFailedException($e->getMessage());
        }
    }
}
