@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a href="{{ route('account') }}" class="nav-link">Account</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.subscriptions') }}" class="nav-link">Subscription</a>
                </li>
                @if(auth()->user()->subscribed())
                  @can('cancel', auth()->user()->subscription('default'))
                   <li class="nav-item">
                    <a href="{{ route('account.subscriptions.cancel') }}" class="nav-link">Cancel Subscription</a>
                   </li>
                  @endcan

                  @can('resume', auth()->user()->subscription('default'))
                    <li class="nav-item">
                        <a href="{{ route('account.subscriptions.resume') }}" class="nav-link">Resume Subscription</a>
                    </li>
                  @endcan

                  <li class="nav-item">
                    <a href="{{ route('account.subscriptions.swap') }}" class="nav-link">
                        Swap plan
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('account.subscriptions.card') }}" class="nav-link">
                        Update card
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('account.subscriptions.coupon') }}" class="nav-link">
                        Apply coupon
                    </a>
                </li>

                @endif

                <li class="nav-item">
                    <a href="{{ route('account.subscriptions.invoices') }}" class="nav-link">
                        Invoices
                    </a>
                </li>

            </ul>
        </div>
        <div class="col-md-9">
           @yield('account')
        </div>
    </div>
</div>
@endsection
