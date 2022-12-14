<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionSwapController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::where('slug', '!=', $request->user()->plan->slug)->get();

        return view('account.subscriptions.swap', compact('plans'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'plan' => 'required|exists:plans,slug'
        ]);

        $request->user()->subscription('default')->swap(Plan::where('slug', $request->plan)->first()->stripe_id);

        return redirect()->route('account.subscriptions');
    }
}
