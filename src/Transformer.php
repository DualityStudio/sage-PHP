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

    /** @var array $response */
    public array $response = [];

    /**
     * parse
     * @param $data
     */
    public function parse($data)
    {
        $jsonDecode = json_decode($data->getBody()->getContents(), true);

        if (!isset($jsonDecode['$items'])) {
            $this->response = $jsonDecode;
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
     * response
     * Returns a single item in its response
     * @return mixed
     */
    public function response()
    {
        return json_decode(collect($this->response)->toJson());
    }

    /**
     * items
     * Returns a list of items as part of the response
     * @return Collection
     */
    public function items(): Collection
    {
        return collect($this->items)->map(function ($map) {
            return (object)$map;
        });
    }
}
