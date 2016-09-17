<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Common\ObjectModel;

class Operations extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * @param array|Operation $operation
     *
     * @return $this
     */
    public function add($operation)
    {
        if (is_array($operation)) {
            $this->collection[] = new Operation($operation);
        } elseif (is_object($operation) && $operation instanceof Operation) {
            $this->collection[] = $operation;
        }

        return $this;
    }

    /**
     * @return Operation[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
