<?php

namespace EntityTransformer\Transformers;

abstract class AbstractTransformer
{
    protected $stTransf;

    public function __construct($transf)
    {
        $this->stTransf = $transf;
    }

    abstract function transform();
}