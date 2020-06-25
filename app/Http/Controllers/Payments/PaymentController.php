<?php

namespace App\Http\Controllers\Payments;

use App\Exceptions\CheckoutMethodNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCheckoutRequest;
use App\Models\Order;
use App\Models\SavedAddress;
use App\Services\Payments\PaymentProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $validated = $request->validated();
        $address = $this->paymentProvider->checkSavedAddress($validated);
        try {
            switch ($validated['payment_option']) {
                case 1:
                    $this->paymentProvider->paypal->pay($request, $address);
                    break;
                case 2:
                    $this->paymentProvider->payu->pay($request, $address);
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
