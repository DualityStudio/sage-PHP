<?php

namespace NicolJamie\Sage\Contacts;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;

class CustomerTypes extends Client
{
    use Transformer;

    /**
     * index
     * @return CustomerTypes
     * @throws \Exception
     */
    public function index(): CustomerTypes
    {
        return $this->parse($this->base('GET', "contact_types"));
    }

    /**
     * show
     * @param $key
     * @return CustomerTypes
     * @throws \Exception
     */
    public function show($key): CustomerTypes
    {
        return $this->parse($this->base('GET', "contact_types/{$key}"));
    }
}
