@extends('layouts.account')

@section('account')
<div class="card">
    <div class="card-header">{{ __('Subscription') }}</div>

    <div class="card-body">
       @if (auth()->user()->subscribed())
       <ul>
           @if ($subscription)
                    <li>
                        Plan: {{ auth()->user()->plan->title }} ({{ $subscription->amount() }}/{{ $subscription->interval() }})
                        @if (auth()->user()->subscription('default')->cancelled())
                            Ends {{ $subscription->cancelAt() }}. <a href="{{ route('account.subscriptions.resume') }}">Resume</a>
                        @endif
                    </li>

                    @if($coupon = $subscription->coupon())
                    <li>
                        Coupon: {{ $coupon->name() }} ({{ $coupon->value() }} off)
                    </li>
                    @endif

               @endif

            @if($invoice)
            <li>
                Next payment: {{ $invoice->amount() }} on {{ $invoice->nextPaymentAttempt() }}
            </li>
            @endif

            @if($customer)
            <li>
                Balance: {{ $customer->balance() }}
            </li>
            @endif

        </ul>
       @else
           <p>You don't have a subscription</p>
       @endif

       <div>
        <a href="{{ auth()->user()->billingPortalUrl(route('account.subscriptions')) }}">Billing portal</a>
       </div>
    </div>
</div>
@endsection
