<?php

namespace NicolJamie\Sage\Contacts;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Contacts\Data\CustomerType;

class CustomerTypes extends Client
{
    /**
     * index
     * @return object
     * @throws \Exception
     */
    public function index(): object
    {
        return CustomerType::data($this->base('GET', "contact_types"));
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws \Exception
     */
    public function show($key): object
    {
        return CustomerType::datum($this->base('GET', "contact_types/{$key}"));
    }
}
