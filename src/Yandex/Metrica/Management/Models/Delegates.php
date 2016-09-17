<?php

namespace Yandex\Metrica\Management\Models;

use Yandex\Common\ObjectModel;

class Delegates extends ObjectModel
{

    protected $collection = [];

    protected $mappingClasses = [];

    protected $propNameMap = [];

    /**
     * @param Delegate|array $delegate
     *
     * @return $this
     */
    public function add($delegate)
    {
        if (is_array($delegate)) {
            $this->collection[] = new Delegate($delegate);
        } elseif (is_object($delegate) && $delegate instanceof Delegate) {
            $this->collection[] = $delegate;
        }

        return $this;
    }

    /**
     * @return Delegate[]
     */
    public function getAll()
    {
        return $this->collection;
    }
}
