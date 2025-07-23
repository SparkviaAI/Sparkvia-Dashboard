/* global $, token, global, subscription, home_url, subscription_url, stripe_url, subscription_new, subscription_activate, subscription_capture, subscription_stripe_activate, subscription_cancel */

import Core from './core';

$(() => {
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
    };

    const POST = 'POST';

    const $el = $('body');

    // CREATE NEW PAYPAL SUBSCRIPTION OBJECT
    // =======================================================
    function createPayPalSubscription(planId, paymentFrequency) {
        return fetch(subscription_new, {
            method: POST,
            headers: {...headers, 'Accept': 'application/json'},
            body: JSON.stringify({
                'plan_id': planId,
                'payment_frequency': paymentFrequency
            })
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }

                return Promise.reject(response);
            })
            .then(data => data);
    }

    // ACTIVATE PAYPAL SUBSCRIPTION
    // =======================================================
    function activatePayPalSubscription(ppSubscriptionId) {
        return fetch(subscription_activate, {
            method: POST,
            headers,
            body: JSON.stringify({
                'pp_subscription_id': ppSubscriptionId
            })
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }

                return Promise.reject(response);
            })
            .then(data => data);
    }

    // ACTIVATE PAYPAL SUBSCRIPTION
    // =======================================================
    function capturePayPalOrder(orderID, planID) {
        return fetch(subscription_capture, {
            method: POST,
            headers,
            body: JSON.stringify({
                'order_id': orderID,
                'plan_id': planID,
            })
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }

                return Promise.reject(response);
            })
            .then(data => data);
    }

    // ACTIVATE STRIPE SUBSCRIPTION
    // =======================================================
    function activateStripeSubscription(stripeSessionId) {
        return fetch(subscription_stripe_activate, {
            method: POST,
            headers,
            body: JSON.stringify({
                'session_id': stripeSessionId,
            })
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }

                return Promise.reject(response);
            })
            .then(data => data);
    }

    // CANCEL PAYPAL SUBSCRIPTION
    // =======================================================
    function cancelSubscription() {
        return fetch(subscription_cancel, {
            method: POST,
            headers,
            body: JSON.stringify({
                'subscription_id': subscription.id
            })
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }

                return Promise.reject(response);
            })
            .then(data => data);
    }

    function checkOnPayPalSubscription() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        if (urlParams.has('success') && urlParams.has('subscription_id')) {
            const success = urlParams.get('success');
            const subscriptionID = urlParams.get('subscription_id');

            if (success) {
                $('#activationModal').modal('show');

                activatePayPalSubscription(subscriptionID).then(data => {
                    window.location.href = home_url;
                }).catch(response => {
                    response.json().then(data => {
                        Core.toastError(data.message);
                    });
                });
            }
        }
    }

    function checkOnPayPalOrder() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        if (urlParams.has('success') && urlParams.has('token')) {
            const success = urlParams.get('success');
            const orderID = urlParams.get('token');
            const planID = urlParams.get('planId');

            if (success && orderID && planID) {
                $('#activationModal').modal('show');

                capturePayPalOrder(orderID, planID).then(data => {
                    window.location.href = home_url;
                }).catch(response => {
                    response.json().then(data => {
                        Core.toastError(data.message);
                    });
                });
            }
        }
    }

    function checkOnStripeSubscription() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        if (urlParams.has('success') && urlParams.has('session_id')) {
            const success = urlParams.get('success');
            const sessionId = urlParams.get('session_id');

            if (success) {
                $('#activationModal').modal('show');

                activateStripeSubscription(sessionId).then(data => {
                    window.location.href = home_url;
                }).catch(response => {
                    response.json().then(data => {
                        Core.toastError(data.message);
                    });
                });
            }
        }
    }

    checkOnPayPalSubscription();
    checkOnPayPalOrder();
    checkOnStripeSubscription();

    const updatePlan = document.querySelector('#btn-upgrade');
    if (updatePlan) {
        updatePlan.addEventListener('click', function () {
            document.querySelector('#upgrade').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    $('#btn-cancel-subscription').click(function () {
        $('#cancelSubscriptionModal').modal('show');
    });

    $('#btn-confirm-cancel-subscription').click(function () {
        this.innerHTML = global.cancelling;
        this.classList.add('disabled');

        cancelSubscription().then(data => {
            this.style.display = 'none';

            document.querySelector('#cancelSubscriptionModalTitle').innerHTML =
                global.subscription_canceled_title;
            document.querySelector('#cancelSubscriptionModalSubTitle').innerHTML =
                global.subscription_canceled_subtitle;

            $('#cancelSubscriptionModal').on('hide.bs.modal', function (event) {
                window.location.href = subscription_url;
            });
        })
            .catch(response => {
                response.json().then(data => {
                    Core.toastError(data.message);
                });
            });
    });

    let planId, onetime, paymentFrequency;

    $('#checkout-paypal').click(function () {
        createPayPalSubscription(planId, paymentFrequency).then(data => {
            window.location.href = data.approval_link;
        }).catch(response => {
            response.json().then(data => {
                Core.toastError(data.message);
            });
        });
    });

    $('#checkout-stripe').click(function () {
        console.log('planId: ' + planId + '   paymentFrequency: ' + paymentFrequency);
        window.location.href = stripe_url.replace(':planId', planId).replace(
            ':paymentFrequency', paymentFrequency);
    });

    $el.on('click', '#checkout_stripe', function (event) {
        const button = $(event.target);
        const planId = button.data('plan-id');
        const routeUrl = button.data('route-url');
        onetime = $(this).data('onetime') || false;
        const frequencySwitch = document.getElementById('pricing');
        paymentFrequency = onetime ? 'onetime' : ((frequencySwitch && frequencySwitch.checked) ? 'yearly' : 'monthly');

        if (planId) {
            window.location.href = routeUrl.replace('monthly', paymentFrequency);
        }
    });

    const divPlans = document.getElementById('div_plans');
    const divOnetime = document.getElementById('div_onetime');
    $('#ckb_onetime').change(function (e) {
        if (e.currentTarget.checked) {
            divOnetime.style.display = 'block';
            divPlans.style.display = 'none';
        }else{
            divPlans.style.display = 'block';
            divOnetime.style.display = 'none';
        }
    });

    $('#ckb_onetime').click(function () {
        $('.details-view-mode').toggle();
        $('.details-edit-mode').toggle();
    });
});
