<?php

namespace App;

use App\Plan;
use App\Presenters\SubscriptionPresenter;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->hasOneThrough(
            Plan::class, Subscription::class,
            'user_id', 'stripe_id', 'id', 'stripe_plan'
        );
    }

    public function presentSubscription() {
        if(!$subscription = $this->subscription('default'))
        {
            return null;
        }

        return new SubscriptionPresenter($subscription->asStripeSubscription());
    }
}

