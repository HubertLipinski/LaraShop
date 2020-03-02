<?php

namespace App\Services\Payments\Models;

use Illuminate\Contracts\Support\Arrayable;
use Psr\Http\Message\ResponseInterface;

class PayuResponseModel
{
    protected $response;
    private $token;
    private $status;
    private $redirectUri;
    private $orderId;

    /**
     * PayuResponseModel constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = json_decode($response->getBody());
        $this->token = isset($this->response->access_token) ? $this->response->access_token : null;
        $this->status = isset($this->response->status) ? $this->response->status : null;
        $this->redirectUri = isset($this->response->redirectUri) ? $this->response->redirectUri : null;
        $this->orderId = isset($this->response->orderId) ? $this->response->orderId : null;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string |null
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return array |null
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @return string |null
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @return string |null
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
