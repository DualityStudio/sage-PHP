<?php

namespace NicolJamie\Sage\Addresses;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;
use GuzzleHttp\Exception\GuzzleException;

class AddressTypes extends Client
{
    use Transformer;

    /**
     * @return AddressTypes
     * @throws \Exception
     */
    public function index(): AddressTypes
    {
        return $this->parse($this->base('GET', "address_types"));
    }

    /**
     * Show
     * @param $key
     * @return AddressTypes
     * @throws GuzzleException|\Exception
     */
    public function show($key): AddressTypes
    {
        return $this->parse($this->base('GET', "address_types/{$key}"));
    }
}
