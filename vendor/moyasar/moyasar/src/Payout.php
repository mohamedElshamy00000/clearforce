<?php

namespace Moyasar;

use GuzzleHttp\Exception\InvalidArgumentException;
use Moyasar\Exceptions\ValidationException;
use Moyasar\Providers\PayoutService;

class Payout extends OnlineResource
{
    /**
     * Payout ID
     *
     * @var string
     */
    public $id;

    /**
     * Status of this payment instance
     *
     * @var string
     */
    public $status;

    /**
     * Payout amount in the lowest unit possible
     *
     * @var int
     */
    public $amount;

    /**
     * Payout fee in the lowest unit possible
     *
     * @var int
     */
    public $fee;

    /**
     * Formatted amount
     *
     * @var string
     */
    public $amountFormat;

    /**
     * Formatted fee
     *
     * @var string
     */
    public $feeFormat;

    /**
     * Currency ISO code
     *
     * @var string
     */
    public $currency;

    /**
     * If this payment was paid for an invoice, this will hold that invoice ID
     *
     * @var string
     */
    public $invoiceId;

    /**
     * Client IP address
     *
     * @var string
     */
    public $ip;

    /**
     * Callback URL
     *
     * @var string
     */
    public $callbackUrl;

    /**
     * Date and time this payment was created
     *
     * @var string
     */
    public $createdAt;

    /**
     * Date and time this payment was updated
     *
     * @var string
     */
    public $updatedAt;

    /**
     * Payout source
     *
     * @var Source
     */
    public $source;

    /**
     * Description of the payment
     *
     * @var array
     */
    public $destination;

    /**
     * Captured amount
     *
     * @var int
     */
    public $captured;

    /**
     * Formatted captured amount
     *
     * @var string
     */
    public $capturedFormat;

    /**
     * Date and time this payment was captured
     *
     * @var string
     */
    public $capturedAt;

    /**
     * Date and time this payment was voided
     *
     * @var string
     */
    public $voidedAt;

    /**
     * Extra payment metadata information
     *
     * @var array
     */
    public $metadata = [];

    protected function __construct()
    {
    }

    protected static function transform($key, $value)
    {
        if ($key == 'source' && is_array($value) && $value['type'] == 'creditcard') {
            return CreditCard::fromArray($value);
        }

        if ($key == 'source' && is_array($value) && $value['type'] == 'sadad') {
            return Sadad::fromArray($value);
        }

        if ($key == 'source' && is_array($value) && $value['type'] == 'applepay') {
            return ApplePay::fromArray($value);
        }

        if ($key == 'source' && is_array($value) && $value['type'] == 'stcpay') {
            return StcPay::fromArray($value);
        }

        return $value;
    }

    protected static function transformBack($key, $value)
    {
        if ($key == 'source') {
            return $value->toSnakeArray();
        }

        return $value;
    }

    /**
     * @param string $description
     * @throws Exceptions\ApiException
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    // public function update($description)
    // {
    //     // $this->validateDescription($description);

    //     $response = $this->client->put(PayoutService::PAYOUT_PATH . "/$this->id", [
    //         'description' => $description
    //     ]);

    //     // A fix, because Moyasar won't return an updated instance of the payment
    //     if (! $response['body_assoc']) {
    //         $response = $this->client->get(PayoutService::PAYOUT_PATH . "/$this->id");
    //     }

    //     $this->updateFromArray($response['body_assoc']);
    // }

    /**
     * Capture a given amount of the authorized payment instance
     *
     * @param int $amount
     * @throws Exceptions\ApiException
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function capture($amount = null)
    {
        if ($amount !== null && !is_int($amount)) {
            throw new InvalidArgumentException('amount must be an int type');
        }

        if ($amount !== null && $amount <= 0) {
            throw new ValidationException('Capture arguments are invalid', [
                'amount' => ['Amount must be a positive integer']
            ]);
        }

        $data = [];

        if ($amount) {
            $data['amount'] = $amount;
        }

        $response = $this->client->post(PayoutService::PAYOUT_PATH . "/$this->id/capture", $data);

        // TODO: Make sure response returns something
        if (! $response['body_assoc']) return;

        $this->updateFromArray($response['body_assoc']);
    }

    /**
     * Void the current payment instance
     *
     * @throws Exceptions\ApiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function void()
    {
        $response = $this->client->post(PayoutService::PAYOUT_PATH . "/$this->id/void");

        // TODO: Make sure response returns something
        if (! $response['body_assoc']) return;

        $this->updateFromArray($response['body_assoc']);
    }

    // private function validateDescription($description)
    // {
    //     if (trim(strlen($description)) == 0) {
    //         throw new ValidationException('Payout description is required', [
    //             'description' => 'A description is required'
    //         ]);
    //     }
    // }
}
