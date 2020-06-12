<?php

namespace App\Http\Controllers\Payments;

use App\Exceptions\CheckoutMethodNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCheckoutRequest;
use App\Services\Payments\PaymentProvider;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    private $paymentProvider;

    /**
     * CartController constructor.
     * @param PaymentProvider $paymentProvider
     */
    public function __construct(PaymentProvider $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    /**
     * @param CreateCheckoutRequest $request
     * $paymentOption: 0 - Credit card, 1 - PayPal, 2 - PayU
     */
    public function checkout(CreateCheckoutRequest $request) : void
    {
        $paymentOption = $request->validated()['payment_option'];
        try {
            switch ($paymentOption) {
                case 1:
                    //database payment create
                    $this->paymentProvider->paypal->pay($request);
                    break;
                case 2:
                    $this->paymentProvider->payu->pay($request);
                    break;
                default: throw new CheckoutMethodNotFound();
            }
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

    public function paymentSuccessful(Request $request)
    {

//        event(new OrderCompleted($order));
//        wyswietlenie podsumowania
    }
}
