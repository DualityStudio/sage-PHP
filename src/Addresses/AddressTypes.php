<?php

namespace NicolJamie\Sage\Addresses;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Addresses\Data\AddressType;
use GuzzleHttp\Exception\GuzzleException;

class AddressTypes extends Client
{
    /**
     * @return object
     * @throws \Exception
     */
    public function index(): object
    {
        return AddressType::data($this->base('GET', "address_types"));
    }

    /**
     * Show
     * @param $key
     * @return object
     * @throws GuzzleException|\Exception
     */
    public function show($key): object
    {
        return AddressType::datum($this->base('GET', "address_types/{$key}"));
    }
}
