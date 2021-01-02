<?php
namespace NicolJamie\Sage\Accounts\Data;

use NicolJamie\Sage\Data;

class Ledger
{
    use Data;

    /** @var string $id */
    public static string $id;

    /** @var string $displayed_ad */
    public static string $displayed_as;

    /** @var array $items */
    public static array $items;
}
