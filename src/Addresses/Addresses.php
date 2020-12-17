<?php

namespace NicolJamie\Sage\Addresses;

use GuzzleHttp\Exception\GuzzleException;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;
use Psr\Http\Message\ResponseInterface;

class Addresses extends Client
{
    use Transformer;

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
     * @return Addresses
     * @throws \Exception
     */
    public function store(array $data, $key = null): Addresses
    {
        $body = [
            'name' => $data['name'],
            'is_main_address' => $data['default'],
            'address_type_id' => $data['address_type'],
            'address_line_1' => $data['address']['line1'],
            'address_line_2' => $data['address']['line2'],
            'city' => $data['address']['city'],
            'postal_code' => $data['address']['postal_code'],
            'country_id' => $data['address']['country_id'],
        ];

        if (!is_null($key)) $body['contact_id'] = $key;

        return $this->parse(
            $this->base('POST', 'addresses', json_encode(['address' => $body]))
        );
    }
}
