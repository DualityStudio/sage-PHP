<?php

namespace DualityStudio\Sage\People;

use Exception;
use DualityStudio\Sage\Client;

class People extends Client
{
    const KEYS = [
        'name', 'contact_person_type_ids', 'job_title', 'telephone', 'mobile', 'email', 'fax'
    ];

    /**
     * index
     * @return object
     * @throws Exception
     */
    public function index(): object
    {
        return Data\People::data($this->base('GET', "contact_persons"));
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws Exception
     */
    public function show($key): object
    {
        return Data\People::datum($this->base('GET', "contact_persons/{$key}"));
    }

    /**
     * store
     * @param $data
     * @param $key
     * @return object
     * @throws Exception
     */
    public function store($data, $key): object
    {
        $body = [];
        foreach (self::KEYS as $str) {
            if (isset($data[$str])) $body[$str] = $data[$str];
        }

        $body = $body + [
                'is_main_contact' => true, 'is_preferred_contact' => true, 'address_id' => $key
            ];

        return Data\People::datum(
            $this->base('POST', 'contact_persons', json_encode(['contact_person' => $body]))
        );
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

        return Data\People::datum(
            $this->base('PUT', "contact_persons/{$key}", json_encode(['contact_person' => $body]))
        );
    }

    /**
     * remove
     * @param string $key
     * @return Client
     * @throws Exception
     */
    public function remove(string $key): Client
    {
        return $this->base('DELETE', "contact_persons/{$key}");
    }
}
