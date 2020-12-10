<?php

namespace NicolJamie\Sage\Invoices;

use GuzzleHttp\Exception\GuzzleException;
use NicolJamie\Sage\Client;
use Psr\Http\Message\ResponseInterface;

class AddressesRequest extends Client
{
    /**
     * fetch
     * @throws GuzzleException
     */
    public function index(): ResponseInterface
    {
        return $this->base('GET', 'addresses');
    }

    /**
     * Show
     */
    public function show()
    {}

    /**
     * Store
     * @throws GuzzleException
     */
    public function store(): ResponseInterface
    {
        return $this->base('POST', '', [

        ]);
    }
}
