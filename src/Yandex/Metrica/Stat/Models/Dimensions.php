<?php

namespace Yandex\Metrica\Stat\Models;

use Yandex\Common\ObjectModel;

class Dimensions extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * Add item
     */
    public function add($dimension)
    {
        if (is_array($dimension)) {
            $this->collection[] = new Dimension($dimension);
        } elseif (is_object($dimension) && $dimension instanceof Dimension) {
            $this->collection[] = $dimension;
        }

        return $this;
    }

    /**
     * Get items
     * @return Dimension[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
