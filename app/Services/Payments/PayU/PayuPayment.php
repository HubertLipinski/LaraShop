<?php

namespace App\Services\Payments\PayU;

use App\Http\Requests\CreateCheckoutRequest;
use App\Services\Payments\Models\PayuResponseModel;
use App\Services\Payments\PaymentBase;
use GuzzleHttp\Exception\GuzzleException;

class PayuPayment extends PaymentBase
{
    /**
     * PayuPayment constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->http = $this->createHttp();
    }

    /**
     * @inheritDoc
     */
    public function getToken(): String
    {
        try {
            $response = $this->http->post(config('payment.payU.oauth_endpoint'), [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('payment.payU.client_id'),
                    'client_secret' => config('payment.payU.client_secret'),
                ],
            ]);

        } catch(GuzzleException $exception) {
            abort(400, $exception->getMessage());
        }

        $response = $this->decodeJson($response);
        return $response->get('access_token');
    }

    /**
     * @param array $params
     */
    public function createRequest(array $params)
    {
        // TODO: Implement createRequest() method.
    }

    /**
     * @return mixed|void
     */
    public function sendRequest()
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function pay(CreateCheckoutRequest $request)
    {
        $this->checkToken();
        // TODO: Implement sendRequest() method.
    }

}
