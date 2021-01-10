<?php

namespace DualityStudio\Sage\People\Data;

use DualityStudio\Sage\Data;

class People
{
    use Data;

    /** @var array $items */
    public static array $items;

    /** @var int $page */
    public static int $page;

    /** @var int $total */
    public static int $total;

    /** @var string $id */
    public static string $id;

    /** @var string $name */
    public static string $name;

    /** @var string $job_title */
    public static string $job_title;

    /** @var string $telephone */
    public static string $telephone;

    /** @var string $mobile */
    public static string $mobile;

    /** @var string $email */
    public static string $email;

    /** @var bool $is_main_contact */
    public static bool $is_main_contact;

    /** @var object $address */
    public static object $address;
}
