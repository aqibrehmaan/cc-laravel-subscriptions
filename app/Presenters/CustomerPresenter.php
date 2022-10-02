<?php

namespace App\Presenters;

use Money\Money;
use Carbon\Carbon;
use Money\Currency;
use NumberFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class CustomerPresenter
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function balance()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter(config('cashier.currency_locale'), NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );

        $money = new Money(
            $this->model->balance,
            new Currency(strtoupper(config('cashier.currency')))
        );

        return $formatter->format($money);
    }
}