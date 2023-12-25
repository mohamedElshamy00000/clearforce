<?php

namespace Moyasar\Providers;

use GuzzleHttp\Client;
use Moyasar\Moyasar;

class GuzzleClientFactory
{
    public function build()
    {
        return new Client($this->options());
    }

    public function options()
    {
        return [
            'base_uri' => Moyasar::CURRENT_VERSION_URL,
            'auth' => [Moyasar::getApiKey(), 'pk_test_shoYzRpcJ5A1YqappB57Qp76qD1cm8K6cYpZkK5Y']
        ];
    }
}