<?php

namespace NicolJamie\Sage\Contacts;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;

class CustomerTypes extends Client
{
    use Transformer;

    /**
     * index
     * @return PeopleTypes
     * @throws \Exception
     */
    public function index(): PeopleTypes
    {
        return $this->parse($this->base('GET', "contact_types"));
    }

    /**
     * show
     * @param $key
     * @return PeopleTypes
     * @throws \Exception
     */
    public function show($key): PeopleTypes
    {
        return $this->parse($this->base('GET', "contact_types/{$key}"));
    }
}
