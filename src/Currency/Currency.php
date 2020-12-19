<?php

namespace NicolJamie\Sage\Currency;

use Exception;
use NicolJamie\Sage\Client;

class Currency extends Client
{
    /**
     * index
     * @return object
     * @throws Exception
     */
    public function index(): object
    {
        return Data\Currency::data($this->base('GET', "currencies"));
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws Exception
     */
    public function show($key): object
    {
        return Data\Currency::datum($this->base('GET', "currencies/{$key}"));
    }
}
