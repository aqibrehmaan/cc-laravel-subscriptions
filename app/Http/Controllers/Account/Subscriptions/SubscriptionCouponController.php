<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use App\Rules\ValidCoupon;
use Illuminate\Http\Request;

class SubscriptionCouponController extends Controller
{
    public function index()
    {
        return view('account.subscriptions.coupon');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon' => [
             'nullable',
             new ValidCoupon()
            ]
        ]);


        $request->user()->subscription('default')->updateStripeSubscription([
            'coupon' => $request->coupon
        ]);

        return redirect()->route('account.subscriptions');

    }
}
