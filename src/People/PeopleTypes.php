<?php

namespace DualityStudio\Sage\People;

use DualityStudio\Sage\Client;
use DualityStudio\Sage\People\Data\PeopleType;
use DualityStudio\Sage\Transformer;

class PeopleTypes extends Client
{
    /**
     * index
     * @return object
     * @throws \Exception
     */
    public function index(): object
    {
        return PeopleType::data($this->base('GET', "contact_person_types"));
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws \Exception
     */
    public function show($key): object
    {
        return PeopleType::datum($this->base('GET', "contact_person_types/{$key}"));
    }
}
