<?php

namespace Yandex\Metrica\Stat\Models;

use Yandex\Common\ObjectModel;

class ComparisonData extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * Add item
     */
    public function add($comparisonItems)
    {
        if (is_array($comparisonItems)) {
            $this->collection[] = new ComparisonItems($comparisonItems);
        } elseif (is_object($comparisonItems) && $comparisonItems instanceof ComparisonItems) {
            $this->collection[] = $comparisonItems;
        }

        return $this;
    }

    /**
     * Get items
     * @return ComparisonItems[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
