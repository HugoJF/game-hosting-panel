<?php

namespace App\Classes;

use ReflectionException;
use ReflectionProperty;

class Resource
{
    public function __construct(array $data = [])
    {
        foreach (get_class_vars(static::class) as $name => $value) {
            try {
                $property = new ReflectionProperty(static::class, $name);
            } catch (ReflectionException $e) {
                continue;
            }

            $type = $property->getType();

            if (!$type) {
                continue;
            }

            if ($type->allowsNull()) {
                $this->$name = null;
            }
        }
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
