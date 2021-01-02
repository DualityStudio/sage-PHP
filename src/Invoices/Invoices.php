<?php

namespace NicolJamie\Sage\Invoices;

use Carbon\Carbon;
use NicolJamie\Sage\Client;
use NicolJamie\Sage\Invoices\Data\Invoice;

class Invoices extends Client
{
    /**
     * index
     * @return object
     * @throws \Exception
     */
    public function index(): object
    {
        return Invoice::data($this->base('GET', 'sales_invoices'));
    }

    /**
     * @param $key
     * @return object
     * @throws \Exception
     */
    public function show($key): object
    {
        return Invoice::datum($this->base('GET', "sales_invoices/{$key}"));
    }

    /**
     * store
     * @param $data
     * @param $key
     * @return false|object
     * @throws \Exception
     */
    public function store($data, $key)
    {
        if (!isset($data['lines']) || !is_array($data['lines'])) return false;

        $body = [
            'date' => Carbon::parse($data['date'])->format('Y-m-d'),
            'invoice_lines' => $data['lines'],
            'contact_id' => $key
        ];

        return Invoice::datum($this->base('POST', 'sales_invoices', json_encode(['sales_invoice' => $body])));
    }

    public function update($key, $data)
    {}

    public function remove($key)
    {}
}
