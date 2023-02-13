<?php

namespace App\Structure;

/**
 * Class containing params for Eloquent orderBy method.
 *
 * Class OrderByItem
 * @package App\Structure
 */
class OrderByItem
{
    /**
     * asc or desc
     *
     * @var string
     */
    private $direction = 'asc';

    /**
     * Column name in the database
     *
     * @var string
     */
    private $column;

    /**
     * OrderByItem constructor.
     * @param string $column
     * @param string $direction
     */
    public function __construct($column, $direction = 'asc')
    {
        $this->column = $column;
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }
}