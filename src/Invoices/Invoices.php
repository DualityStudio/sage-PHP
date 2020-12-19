<?php

namespace NicolJamie\Sage\Invoices;

use NicolJamie\Sage\Client;
use NicolJamie\Sage\Transformer;

class Invoices extends Client
{
    use Transformer;

    /**
     * index
     * @return Invoices
     * @throws \Exception
     */
    public function index(): Invoices
    {
        return $this->parse($this->base('GET', 'addresses'));
    }

    public function show($key)
    {}

    public function store()
    {
        $this->base('POST', '', [

        ]);
    }

    public function update($key, $data)
    {}

    public function remove($key)
    {}
}
