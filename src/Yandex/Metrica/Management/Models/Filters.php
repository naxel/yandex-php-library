<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Common\ObjectModel;

class Filters extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * @param Filter|array $filter
     *
     * @return $this
     */
    public function add($filter)
    {
        if (is_array($filter)) {
            $this->collection[] = new Filter($filter);
        } elseif (is_object($filter) && $filter instanceof Filter) {
            $this->collection[] = $filter;
        }

        return $this;
    }

    /**
     * @return Filter[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
