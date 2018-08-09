<?php

namespace EntityTransformer\EntityTransformer;

use EntityTransformer\Transformers\FirstOrNullTransformer;
use EntityTransformer\Transformers\SimpleTransformer;

class TransformerFactory
{
    const SIMPLE = 'simple';

    const FIRST_NOT_NULL = 'first_not_null';

    public static function create($entity, $key, $transformation)
    {
        switch ($key) {
            case self::FIRST_NOT_NULL:
                return new FirstOrNullTransformer($entity, $transformation);
            default:
                return new SimpleTransformer($entity, $transformation);
        }
    }
}