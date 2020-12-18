<?php

namespace NicolJamie\Sage\People;

use Exception;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;
use Psr\Http\Message\ResponseInterface;

class People extends Client
{
    use Transformer;

    const KEYS = [
        'name', 'contact_person_type_ids', 'job_title', 'telephone', 'mobile', 'email', 'fax'
    ];

    /**
     * index
     * @return People
     * @throws Exception
     */
    public function index(): People
    {
        return $this->parse($this->base('GET', "contact_persons"));
    }

    /**
     * show
     * @param $key
     * @return People
     * @throws Exception
     */
    public function show($key): People
    {
        return $this->parse($this->base('GET', "contact_persons/{$key}"));
    }

    /**
     * store
     * @param $data
     * @param $key
     * @return People
     * @throws Exception
     */
    public function store($data, $key): People
    {
        $body = [];
        foreach (self::KEYS as $str) {
            if (isset($data[$str])) $body[$str] = $data[$str];
        }

        $body = $body + [
            'is_main_contact' => true, 'is_preferred_contact' => true, 'address_id' => $key
        ];

        return $this->parse(
            $this->base('POST', 'contact_persons', json_encode(['contact_person' => $body]))
        );
    }

    /**
     * update
     * @param $data
     * @param $key
     * @return People
     * @throws Exception
     */
    public function update($data, $key): People
    {
        $body = [];
        foreach (self::KEYS as $item) {
            if (isset($data[$item])) $body[$item] = $data[$item];
        }

        return $this->parse(
            $this->base('PUT', "contact_persons/{$key}", json_encode(['contact_person' => $body]))
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
        return $this->base('DELETE', "contact_persons/{$key}");
    }
}
