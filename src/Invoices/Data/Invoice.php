<?php
namespace NicolJamie\Sage\Invoices\Data;

use NicolJamie\Sage\Data;

class Invoice
{
    use Data;

    /** @var string|null $id */
    public static ?string $id = '';

    /** @var string|null $invoice_number */
    public static ?string $invoice_number;

    /** @var string $date */
    public static string $date;

    /** @var string $due_date */
    public static string $due_date;

    /** @var object $contact */
    public static object $contact;

    /** @var int|null $total */
    public static ?int $total;

    /** @var int|null $page */
    public static ?int $page;

    /** @var array|null $items */
    public static ?array $items;
}
