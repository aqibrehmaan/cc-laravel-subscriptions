@extends('layouts.account')

@section('account')
<div class="card">
    <div class="card-header">{{ __('Subscription') }}</div>

    <div class="card-body">
       @if (auth()->user()->subscribed())
           @if ($subscription)
               <ul>
                    <li>
                        Plan: {{ auth()->user()->plan->title }} ({{ $subscription->amount() }}/{{ $subscription->interval() }})
                        @if (auth()->user()->subscription('default')->cancelled())
                            Ends {{ $subscription->cancelAt() }}. <a href="{{ route('account.subscriptions.resume') }}">Resume</a>
                        @endif
                    </li>
               </ul>
               @endif
            @else
           <p>You don't have a subscription</p>
       @endif

       <div>
        <a href="{{ auth()->user()->billingPortalUrl(route('account.subscriptions')) }}">Billing portal</a>
       </div>
    </div>
</div>
@endsection
