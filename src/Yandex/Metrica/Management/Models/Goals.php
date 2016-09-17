<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Common\ObjectModel;

class Goals extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * @param Goal|array $goal
     *
     * @return $this
     */
    public function add($goal)
    {
        if (is_array($goal)) {
            $this->collection[] = new Goal($goal);
        } elseif (is_object($goal) && $goal instanceof Goal) {
            $this->collection[] = $goal;
        }

        return $this;
    }

    /**
     * @return Goal[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
