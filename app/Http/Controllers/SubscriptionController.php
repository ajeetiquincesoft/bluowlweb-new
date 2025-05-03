<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('subsciptionDataView', compact('subscriptions'));
    }


    public function addSubscription(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Step 1: Create Product in Stripe
        $stripeProduct = Product::create([
            'name' => $request->name,
        ]);

        // Step 2: Create Price in Stripe
        $stripePrice = Price::create([
            'unit_amount' => $request->price * 100, // price in cents
            'currency' => 'usd',
            'recurring' => [
                'interval' => $request->duration == 30 ? 'month' : 'year',
            ],
            'product' => $stripeProduct->id,
        ]);

        // Step 3: Prepare local data
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
            'features' => $request->features ? json_encode($request->features) : null,
            'stripe_price_id' => $stripePrice->id, // VERY IMPORTANT
        ];

        // Step 4: Save to your DB
        Subscription::create($data);

        return redirect()->back()->with('success', 'Subscription added successfully with Stripe integration!');
    }


    // public function addSubscription(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'price' => 'required|numeric',
    //         'duration' => 'required|integer',
    //         'description' => 'nullable|string',
    //         'features' => 'nullable|array',
    //     ]);

    //     $data = $request->all();

    //     // Check if features exist and encode it to JSON
    //     if ($request->has('features')) {
    //         $data['features'] = json_encode($request->features);
    //     }

    //     // Create the subscription record with the validated data
    //     Subscription::create($data);

    //     return redirect()->back()->with('success', 'Subscription added successfully!');
    // }
    public function editSubscription(Request $request, $id)
    {

        $validated = $request->validate([
            'id' => 'required|exists:subscriptions,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
        ]);
        $sub_id = Crypt::decrypt($id);
        $subscription = Subscription::findOrFail($sub_id);

        $subscription->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'description' => $validated['description'],
            'features' => json_encode($validated['features'] ?? []),
        ]);

        return back()->with('success', 'Subscription updated successfully!');
    }
}
