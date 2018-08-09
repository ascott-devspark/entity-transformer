<?php

namespace EntityTransformer\Transformers;

use EntityTransformer\EntityTransformer\TransformerFactory;

class FirstOrNullTransformer extends AbstractTransformer
{
    public function __construct($entity, $transf)
    {
        parent::__construct($entity, explode(',', $transf));
    }

    public function transform($value)
    {
       foreach ($this->trans as $transformation) {
           $transformer = TransformerFactory::create($this->entity, TransformerFactory::SIMPLE, $transformation);
           $newValue = $transformer->transform($value);
           if (!empty($newValue)) {
               return $newValue;
           }
       }

       return null;
    }
}