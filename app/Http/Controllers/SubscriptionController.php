<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('subsciptionDataView',compact('subscriptions'));
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

        $data = $request->all();

        // Check if features exist and encode it to JSON
        if ($request->has('features')) {
            $data['features'] = json_encode($request->features);
        }

        // Create the subscription record with the validated data
        Subscription::create($data);

        return redirect()->back()->with('success', 'Subscription added successfully!');
    }
    public function editSubscription(Request $request ,$id)
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
