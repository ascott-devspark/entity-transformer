<?php

namespace EntityTransformer\Transformers;

class SimpleTransformer extends AbstractTransformer
{
    public function __construct($entity, $transf)
    {
        parent::__construct($entity, trim($transf));
    }

    public function transform($property)
    {
        // TODO: Implement transform() method.
    }
}