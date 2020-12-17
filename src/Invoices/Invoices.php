<?php

namespace NicolJamie\Sage\Invoices;

use GuzzleHttp\Exception\GuzzleException;
use NicolJamie\Sage\Client;

class Invoices extends Client
{
    /**
     * fetch
     * @throws GuzzleException
     */
    public function fetch()
    {
        $request = $this->base('GET', 'addresses');

        dd(json_decode($request->getBody()->getContents()));
    }

    public function store()
    {
        $this->base('POST', '', [

        ]);
    }
}
