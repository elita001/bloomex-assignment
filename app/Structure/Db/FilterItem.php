<?php

namespace App\Structure\Db;

/**
 * Class containing params for Eloquent where method.
 *
 * Class FilterItem
 * @package App\Structure\Db
 */
class FilterItem
{
    /**
     * Relationship name if the column is from another table (Optional)
     * Used in whereHas method
     *
     * @var string
     */
    private $relation;

    /**
     * Column name in the database
     *
     * @var string
     */
    private $column;

    /**
     * Operator applied to the column value
     * (=, <, >)
     *
     * @var string
     */
    private $operator;

    /**
     * Column value
     *
     * @var string
     */
    private $value;

    const ALLOWED_OPERATOR = [
        '=',
        '<',
        '<=',
        '>',
        '>=',
        // TODO implement "like" and "in" operators usage
//        'like',
//        'in'
    ];

    /**
     * FilterItem constructor.
     * @param $column
     * @param $operator
     * @param $value
     * @param string $relation
     * @throws \Exception
     */
    public function __construct($column, $operator, $value, $relation = null)
    {
        if (!in_array($operator, static::ALLOWED_OPERATOR)) {
            throw new \Exception(sprintf('%s operator is not allowed', $operator));
        }
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
        $this->relation = $relation;
    }

    /**
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getRelation()
    {
        return $this->relation;
    }
}