<?php

namespace DualityStudio\Sage\Contacts\Data;

use DualityStudio\Sage\Data;

class CustomerType
{
    use Data;

    /** @var string|null $id */
    public static ?string $id = '';

    /** @var int|null $total */
    public static ?int $total;

    /** @var int|null $page */
    public static ?int $page;

    /** @var array|null $items */
    public static ?array $items;
}
