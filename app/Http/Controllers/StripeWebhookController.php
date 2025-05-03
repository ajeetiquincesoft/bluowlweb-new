<?php

namespace App\Http\Controllers;

use App\Models\VendorSubscription;
use App\Models\Subscription;

use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $eventType = $payload['type'] ?? '';

        if ($eventType === 'invoice.payment_succeeded') {
            $subscriptionId = $payload['data']['object']['subscription'];

            $vendorSubscription = VendorSubscription::where('stripe_subscription_id', $subscriptionId)->first();

            if ($vendorSubscription) {
                // Get duration again if needed from subscriptions table
                $subscription = Subscription::find($vendorSubscription->subscriptions_id);

                $vendorSubscription->starts_at = now();
                $vendorSubscription->ends_at = now()->addDays($subscription->duration); // Keep same logic
                $vendorSubscription->status = 1;
                $vendorSubscription->save();
            }
        }

        return response()->json(['received' => true]);
    }
}
