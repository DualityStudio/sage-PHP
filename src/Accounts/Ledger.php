<?php

namespace DualityStudio\Sage\Accounts;

use Exception;
use DualityStudio\Sage\Client;

class Ledger extends Client
{
    /**
     * index
     * @return object
     * @throws Exception
     */
    public function index(): object
    {
        return Data\Ledger::data($this->base('GET', "ledger_accounts?visible_in=sales"));
    }

    /**
     * show
     * @param $key
     * @return object
     * @throws Exception
     */
    public function show($key): object
    {
        return Data\Ledger::datum($this->base('GET', "ledger_accounts/{$key}"));
    }
}
