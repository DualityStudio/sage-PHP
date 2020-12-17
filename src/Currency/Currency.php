<?php

namespace NicolJamie\Sage\Currency;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;

class Currency extends Client
{
    use Transformer;

    /**
     * index
     * @return Currency
     * @throws \Exception
     */
    public function index(): Currency
    {
        return $this->parse($this->base('GET', "currencies"));
    }

    /**
     * show
     * @param $key
     * @return Currency
     * @throws \Exception
     */
    public function show($key): Currency
    {
        return $this->parse($this->base('GET', "currencies/{$key}"));
    }
}
