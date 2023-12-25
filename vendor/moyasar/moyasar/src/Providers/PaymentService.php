<?php

namespace Moyasar\Providers;

use Moyasar\Contracts\HttpClient as ClientContract;
use Moyasar\PaginationResult;
use Moyasar\Payment;
use Moyasar\Search;

class PaymentService
{
    const PAYMENT_PATH = 'payments';

    /**
     * @var ClientContract
     */
    protected $client;

    public function __construct($client = null)
    {
        if ($client == null) {
            $client = new HttpClient();
        }

        $this->client = $client;
    }

    /**
     * Fetches a payment from Moyasar servers
     *
     * @param string $id
     * @return Payment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Moyasar\Exceptions\ApiException
     */
    public function fetch($id)
    {
        $response = $this->client->get(self::PAYMENT_PATH . "/$id");
        $payment = Payment::fromArray($response['body_assoc']);
        $payment->setClient($this->client);
        return $payment;
    }

    /**
     * Fetches all payments from Moyasar servers
     *
     * @param Search|array|null $query
     * @return PaginationResult
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Moyasar\Exceptions\ApiException
     */
    public function all($query = null)
    {
        if ($query instanceof Search) {
            $query = $query->toArray();
        }

        $response = $this->client->get(self::PAYMENT_PATH, $query);
        $data = $response['body_assoc'];
        $meta = $data['meta'];
        $payments = array_map(function ($i) {
            $payment = Payment::fromArray($i);
            $payment->setClient($this->client);
            return $payment;
        }, $data['payments']);

        return PaginationResult::fromArray($meta)->setResult($payments);
    }

    private function defaultCreateArguments()
    {
        return [
            'currency' => 'SAR'
        ];
    }
    /**
     * Validates arguments meant to be used with invoice create
     *
     * @param $arguments
     * @throws ValidationException
     */
    private function validateCreateArguments($arguments)
    {
        $errors = [];

        if (!isset($arguments['amount'])) {
            $errors['amount'][] = 'Amount is required';
        }

        if (isset($arguments['amount']) && (!is_int($arguments['amount']) || $arguments['amount'] <= 0)) {
            $errors['amount'][] = 'Amount must be a positive integer greater than 0';
        }

        if (!isset($arguments['currency'])) {
            $errors['currency'][] = 'Currency is required';
        }

        if (isset($arguments['currency']) && strlen($arguments['currency']) != 3) {
            $errors['currency'][] = 'Currency must be a 3-letter currency ISO code';
        }

        if (!isset($arguments['description']) || strlen(trim($arguments['description'])) == 0) {
            $errors['description'][] = 'A description is required';
        }

        if (count($errors)) {
            // dd( $errors);

            throw new ValidationException('Invoice arguments are invalid', $errors);
        }
    }
    /**
     * Creates a new invoice at Moyasar and return an Invoice object
     *
     * @param array $arguments
     * @return Payment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Moyasar\Exceptions\ApiException
     */
    public function create($arguments)
    {
        $arguments = array_merge($this->defaultCreateArguments(), $arguments);
        $this->validateCreateArguments($arguments);

        $response = $this->client->post(self::PAYMENT_PATH, $arguments);
        $data = $response['body_assoc'];

        $payment = Payment::fromArray($data);
        $payment->setClient($this->client);
        return $payment;
    }

}