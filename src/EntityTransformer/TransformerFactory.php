<?php

namespace EntityTransformer\EntityTransformer;

use EntityTransformer\Transformers\FirstOrNullTransformer;
use EntityTransformer\Transformers\SimpleTransformer;

class TransformerFactory
{
    const SIMPLE = 'simple';

    const FIRST_NOT_NULL = 'first_not_null';

    public static function create($key, $transformation)
    {
        switch ($key) {
            case self::FIRST_NOT_NULL:
                return new FirstOrNullTransformer($transformation);
            default:
                return new SimpleTransformer($transformation);
        }
    }
}