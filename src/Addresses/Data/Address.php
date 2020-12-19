<?php
namespace NicolJamie\Sage\Addresses\Data;

use NicolJamie\Sage\Data;

class Address
{
    use Data;

    /** @var string $id */
    public static string $id;

    /** @var string $address_line_1 */
    public static string $address_line_1;

    /** @var string $address_line_2 */
    public static string $address_line_2;

    /** @var string $city */
    public static string $city;

    /** @var string $postal_code */
    public static string $postal_code;

    /** @var bool $is_main_address */
    public static bool $is_main_address;

    /** @var object $contact */
    public static object $contact;
}
