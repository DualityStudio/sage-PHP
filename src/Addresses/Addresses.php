<?php

namespace NicolJamie\Sage\Addresses;

use GuzzleHttp\Exception\GuzzleException;
use NicolJamie\Sage\Addresses\Data\Address;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;
use Psr\Http\Message\ResponseInterface;

class Addresses extends Client
{
    const KEYS = [
        'name', 'is_main_address', 'address_type_id', 'address_line_1', 'address_line_2', 'city',
        'postal_code', 'country_id', 'contact_id'
    ];

    /**
     * index
     * @return object
     * @throws \Exception
     */
    public function index(): object
    {
        return Address::data($this->base('GET', "addresses"));
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws \Exception
     */
    public function show($key): object
    {
        return Address::datum($this->base('GET', "addresses/{$key}"));
    }

    /**
     * store
     * @param $key
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function store(array $data, $key = null): object
    {
        $body = [];
        foreach (self::KEYS as $str) {
            if (isset($data[$str])) $body[$str] = $data[$str];
        }

        if (!is_null($key)) $body['contact_id'] = $key;

        return Address::datum($this->base('POST', 'addresses', json_encode(['address' => $body])));
    }

    /**
     * update
     * @param $data
     * @param $key
     * @return object
     * @throws \Exception
     */
    public function update($data, $key): object
    {
        $body = [];
        foreach (self::KEYS as $str) {
            if (isset($data[$str])) $body[$str] = $data[$str];
        }

        return Address::datum($this->base('PUT', "addresses/{$key}", json_encode(['address' => $body])));
    }

    /**
     * remove
     * @param $key
     * @return Client
     * @throws \Exception
     */
    public function remove($key): Client
    {
        return $this->base('DELETE', "addresses/{$key}");
    }
}
