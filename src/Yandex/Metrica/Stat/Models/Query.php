<?php

namespace Yandex\Metrica\Stat\Models;

use Yandex\Common\Model;

/**
 * Class Query
 * @package Yandex\Metrica\Stat\Models
 */
class Query extends Model
{
    protected $id = null;

    /**
     * Identifiers of counters. Used instead of the parameter id.
     * @var int[]
     */
    protected $ids = null;

    protected $preset = null;

    protected $dimensions = null;

    protected $metrics = null;

    protected $sort = null;

    protected $limit = null;

    protected $offset = null;

    protected $date1 = null;

    protected $date2 = null;

    protected $filters = null;

    protected $group = null;

    protected $autoGroupType = null;

    protected $autoGroupSize = null;

    protected $mappingClasses = [];

    protected $propNameMap = [
        'auto_group_type' => 'autoGroupType',
        'auto_group_size' => 'autoGroupSize'
    ];

    /**
     * Retrieve the id property
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id property
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * Retrieve the ids property
     *
     * @return int[]|null
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * Set the ids property
     *
     * @param int[] $ids
     * @return $this
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
        return $this;
    }

    /**
     * Retrieve the preset property
     *
     * @return string|null
     */
    public function getPreset()
    {
        return $this->preset;
    }

    /**
     * Set the preset property
     *
     * @param string $preset
     * @return $this
     */
    public function setPreset($preset)
    {
        $this->preset = $preset;
        return $this;
    }

    /**
     * Retrieve the dimensions property
     *
     * @return array|null
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Set the dimensions property
     *
     * @param array $dimensions
     * @return $this
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * Retrieve the metrics property
     *
     * @return array|null
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * Set the metrics property
     *
     * @param array $metrics
     * @return $this
     */
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
        return $this;
    }

    /**
     * Retrieve the sort property
     *
     * @return array|null
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set the sort property
     *
     * @param array $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Retrieve the limit property
     *
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the limit property
     *
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Retrieve the offset property
     *
     * @return int|null
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set the offset property
     *
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Retrieve the date1 property
     *
     * @return string|null
     */
    public function getDate1()
    {
        return $this->date1;
    }

    /**
     * Set the date1 property
     *
     * @param string $date1
     * @return $this
     */
    public function setDate1($date1)
    {
        $this->date1 = $date1;
        return $this;
    }

    /**
     * Retrieve the date2 property
     *
     * @return string|null
     */
    public function getDate2()
    {
        return $this->date2;
    }

    /**
     * Set the date2 property
     *
     * @param string $date2
     * @return $this
     */
    public function setDate2($date2)
    {
        $this->date2 = $date2;
        return $this;
    }

    /**
     * Retrieve the filters property
     *
     * @return string|null
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set the filters property
     *
     * @param string $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * Retrieve the group property
     *
     * @return string|null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set the group property
     *
     * @param string $group
     * @return $this
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Retrieve the autoGroupType property
     *
     * @return string|null
     */
    public function getAutoGroupType()
    {
        return $this->autoGroupType;
    }

    /**
     * Set the autoGroupType property
     *
     * @param string $autoGroupType
     * @return $this
     */
    public function setAutoGroupType($autoGroupType)
    {
        $this->autoGroupType = $autoGroupType;
        return $this;
    }

    /**
     * Retrieve the autoGroupSize property
     *
     * @return string|null
     */
    public function getAutoGroupSize()
    {
        return $this->autoGroupSize;
    }

    /**
     * Set the autoGroupSize property
     *
     * @param string $autoGroupSize
     * @return $this
     */
    public function setAutoGroupSize($autoGroupSize)
    {
        $this->autoGroupSize = $autoGroupSize;
        return $this;
    }
}
