<?php

namespace NicolJamie\Sage\Contacts;

use Exception;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Contacts\Data\Customer;

class Customers extends Client
{
    const KEYS = [
        'name', 'contact_type_ids', 'reference', 'currency_id', 'tax_number'
    ];

    /**
     * index
     * @return Client
     * @throws Exception
     */
    public function index(): Client
    {
        return $this->base('GET', "contacts");
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws Exception
     */
    public function show($key): object
    {
        return Customer::datum($this->base('GET', "contacts/{$key}"));
    }

    /**
     * store
     * @param $data
     * @return object
     * @throws Exception
     */
    public function store($data): object
    {
        $body = [];
        foreach (self::KEYS as $str) {
            if (isset($data[$str])) $body[$str] = $data[$str];
        }

        return Customer::datum($this->base('POST', 'contacts', json_encode(['contact' => $body])));
    }

    /**
     * update
     * @param $data
     * @param $key
     * @return object
     * @throws Exception
     */
    public function update($data, $key): object
    {
        $body = [];
        foreach (self::KEYS as $item) {
            if (isset($data[$item])) $body[$item] = $data[$item];
        }

        return Customer::datum($this->base('PUT', "contacts/{$key}", json_encode(['contact' => $body])));
    }

    /**
     * remove
     * @param string $key
     * @return Client
     * @throws Exception
     */
    public function remove(string $key): Client
    {
        return $this->base('DELETE', "contacts/{$key}");
    }
}
