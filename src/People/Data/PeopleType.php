<?php

namespace DualityStudio\Sage\People\Data;

use DualityStudio\Sage\Data;

class PeopleType
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
