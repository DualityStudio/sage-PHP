<?php

namespace NicolJamie\Sage;

use Illuminate\Support\Collection;

trait Transformer
{
    /** @var int $total */
    public int $total = 1;

    /** @var int $page */
    public int $page = 1;

    /** @var array $items */
    public array $items = [];

    /** @var bool $singular */
    public bool $singular = false;

    /**
     * parse
     * @param $data
     */
    public function parse($data)
    {
        $jsonDecode = json_decode($data->getBody()->getContents(), true);

        if (!isset($jsonDecode['$items'])) {
            $this->singular = true;
            $this->items = $jsonDecode;
        } else {
            foreach (get_object_vars($this) as $property => $value) {
                if (isset($jsonDecode['$' . $property])) $this->$property = $jsonDecode['$' . $property];
            }
        }

        return $this;
    }

    /**
     * total
     * @return int
     */
    public function total(): int
    {
        return $this->total;
    }

    /**
     * page
     * @return int
     */
    public function page(): int
    {
        return $this->page;
    }

    /**
     * items
     * @return Collection|string
     */
    public function items()
    {
        if ($this->singular) return json_decode(collect($this->items)->toJson());

        return collect($this->items)->map(function ($map) {
            return (object)$map;
        });
    }
}
