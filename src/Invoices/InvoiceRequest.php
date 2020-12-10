<?php

use NicolJamie\SagePHP\Client;

class InvoiceRequest extends Client
{
    public function fetch()
    {
        $this->get('/addresses');
    }
}
