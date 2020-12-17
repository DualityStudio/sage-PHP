<?php

namespace NicolJamie\Sage\Contacts;

use Exception;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;
use Psr\Http\Message\ResponseInterface;

class Customers extends Client
{
    use Transformer;

    /**
     * index
     * @return Customers
     * @throws Exception
     */
    public function index(): Customers
    {
        return $this->parse($this->base('GET', "contacts"));
    }

    /**
     * show
     * @param $key
     * @return Customers
     * @throws Exception
     */
    public function show($key): Customers
    {
        return $this->parse($this->base('GET', "contacts/{$key}"));
    }

    /**
     * store
     * @param $data
     * @return Customers
     * @throws Exception
     */
    public function store($data): Customers
    {
        $body = [
            'name' => $data['name'],
            'contact_type_ids' => [$data['type']],
            'reference' => $data['reference'],
            'currency_id' => $data['currency'],
        ];

        if (isset($data['address'])) {
            $body['main_address'] = $data['address'];
        }

        return $this->parse(
            $this->base('POST', 'contacts', json_encode(['contact' => $body]))
        );
    }

    /**
     * update
     * @param $key
     * @param $data
     * @return Customers
     * @throws Exception
     */
    public function update($key, $data): Customers
    {
        $keys = ['name', 'contact_type_ids', 'reference', 'currency_id', 'tax_number'];

        $body = [];
        foreach ($keys as $item) {
            if (isset($data[$item])) $body[$item] = $data[$item];
        }

        return $this->parse(
            $this->base('PUT', "contacts/{$key}", json_encode(['contact' => $body]))
        );
    }

    /**
     * remove
     * @param string $key
     * @return ResponseInterface
     * @throws Exception
     */
    public function remove(string $key): ResponseInterface
    {
        return $this->base('DELETE', "contacts/{$key}");
    }
}
