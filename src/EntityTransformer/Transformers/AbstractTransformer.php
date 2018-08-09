<?php

namespace EntityTransformer\Transformers;

abstract class AbstractTransformer
{
    protected $transf;

    protected $entity;

    public function __construct($entity, $transf)
    {
        $this->entity = $entity;
        $this->transf = $transf;
    }

    abstract function transform();
}