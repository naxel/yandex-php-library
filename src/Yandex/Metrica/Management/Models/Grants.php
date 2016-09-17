<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Common\ObjectModel;

class Grants extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * @param array|Grant $grant
     *
     * @return $this
     */
    public function add($grant)
    {
        if (is_array($grant)) {
            $this->collection[] = new Grant($grant);
        } elseif (is_object($grant) && $grant instanceof Grant) {
            $this->collection[] = $grant;
        }

        return $this;
    }

    /**
     * @return Grant[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
