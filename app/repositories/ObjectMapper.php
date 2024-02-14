<?php

class ObjectMapper
{
    public static function mapToObject(array $data, $className)
    {
        if (!class_exists($className)) {
            throw new InvalidArgumentException("Class $className does not exist");
        }

        $object = new $className();

        foreach ($data as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }
}

?>
