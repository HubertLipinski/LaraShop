<?php

namespace App\Services\Payments;

use App\Models\PaymentHistory;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface;

abstract class PaymentBase
{
    protected $paymentHistory = null;
    protected $http = null;
    protected $token = null;

    /**
     * PaymentBase constructor.
     *
     */
    public function __construct() {
        $this->paymentHistory = PaymentHistory::class;
    }

    /**
     * Get authentication token from API provider
     *
     * @return String
     */
    public abstract function getToken() : String;

    /**
     * Create request for API provider
     *
     * @return mixed
     */
    public abstract function createRequest();

    /**
     * Sends request to API provider
     *
     * @return mixed
     */
    public abstract function sendRequest();

    /**
     * Returns Http Guzzle client
     *
     * @param string $token
     * @param array $headers
     * @return Client
     */
    protected function createHttp(string $token = "", array $headers = []) : Client {
        if(count($headers) <= 0) {
            $headers = [
                'Content-Type' => 'application/json',
            ];
        }
        if (strlen($token) > 0)
            $headers['Authorization'] = 'Bearer '.$token;

        return new Client(['headers' => $headers]);
    }

    protected final function decodeJson(ResponseInterface $response, bool $assoc = true) : Collection {
        $decoded = json_decode($response->getBody(), $assoc);
        return collect($decoded);
    }

    /**
     * Clears User's cart.
     */
    protected final function clearCart(): void {
        $cart = Auth::user()->cart;
        $cart->delete();
        Auth::user()->cart()->create();
    }
}
