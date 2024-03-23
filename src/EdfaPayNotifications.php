<?php

namespace alalm3i\EdfaPay;

abstract class EdfaPayNotifications
{
    public array $responseArray = [];

    /*
     *  $response : is the request content - $requests->getContent()
     */
    public function __construct($response)
    {
        $this->responseArray = $this->toArray($response);
    }

    public function isSale(): bool
    {
        return $this->responseArray['action'] == 'SALE';
    }

    public function isSuccess(): bool
    {
        return $this->responseArray['result'] == 'SUCCESS';
    }

    public function isDeclined(): bool
    {
        return $this->responseArray['result'] == 'DECLINED';
    }

    public function isRedirect(): bool
    {
        return $this->responseArray['result'] == 'REDIRECT';
    }

    public function getStatus(): string
    {
        return $this->responseArray['status'];
    }

    public function getOrderId(): string
    {
        return $this->responseArray['order_id'];
    }

    public function getTransactionId(): string
    {
        return $this->responseArray['trans_id'];
    }

    public function getTransactinoDate(): string
    {
        return $this->responseArray['trans_date'];
    }

    public function getAmount(): string
    {
        return $this->responseArray['amount'];
    }

    public function getJsonResponse(): string
    {
        return json_encode($this->responseArray);
    }

    private function toArray($response): array
    {
        $result = [];
        $items = explode('&', $response);

        foreach ($items as $item) {
            $single = explode('=', $item);
            $result[$single[0]] = trim(urldecode($single[1]));
        }

        return $result;
    }
}
