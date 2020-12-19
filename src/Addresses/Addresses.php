<?php

namespace NicolJamie\Sage\Addresses;

use GuzzleHttp\Exception\GuzzleException;
use NicolJamie\Sage\Addresses\Data\Address;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;
use Psr\Http\Message\ResponseInterface;

class Addresses extends Client
{
    use Transformer;

    const KEYS = [
        'name', 'is_main_address', 'address_type_id', 'address_line_1', 'address_line_2', 'city',
        'postal_code', 'country_id', 'contact_id'
    ];

    /**
     * index
     * @return Addresses
     * @throws \Exception
     */
    public function index(): Addresses
    {
        return $this->parse($this->base('GET', "addresses"));
    }

    /**
     * show
     * @param $key
     * @return Addresses
     * @throws \Exception
     */
    public function show($key): Addresses
    {
        return $this->parse($this->base('GET', "addresses/{$key}"));
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
     * @return Addresses
     * @throws \Exception
     */
    public function update($data, $key): Addresses
    {
        $body = [];
        foreach (self::KEYS as $str) {
            if (isset($data[$str])) $body[$str] = $data[$str];
        }

        return $this->parse(
            $this->base('PUT', "addresses/{$key}", json_encode(['address' => $body]))
        );
    }

    /**
     * remove
     * @return Addresses
     * @throws \Exception
     */
    public function remove(): Addresses
    {
        return $this->parse($this->base('DELETE', ''));
    }
}
