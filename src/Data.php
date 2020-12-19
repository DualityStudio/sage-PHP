<?php

namespace NicolJamie\Sage;

trait Data
{
    /**
     * datum
     * @param $data
     * @return object
     */
    public static function datum($data): object
    {
        $response = $data->response();

        foreach (get_class_vars(self::class) as $property => $value) {
            self::$$property = $response->$property;
        }

        return (object)get_class_vars(get_class(new self()));
    }

    /**
     * datum
     * @param $data
     * @return object
     */
    public static function data($data): object
    {
        $properties = get_class_vars(self::class);

        foreach ($properties as $property => $var) {
            if (isset($data->$property) && !is_array($data->$property)) self::$$property = $data->$property;
        }

        foreach ($data->items() as $key => $value) {
            $item = [];
            foreach ($properties as $property => $var) {
                if (isset($value->$property)) $item[$property] = $value->$property;
            }

            self::$items[] = (object)$item;
        }

        $returnObject = (object)get_class_vars(get_class(new self()));

        foreach ($returnObject as $item => $value) {
            if (empty($value)) unset($returnObject->$item);
        }

        return $returnObject;
    }
}
