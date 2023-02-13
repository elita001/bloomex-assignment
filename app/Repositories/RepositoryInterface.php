<?php

namespace App\Repositories;

use App\Structure\OrderByItem;

interface RepositoryInterface
{
    const LIMIT = 100;

    /**
     * @param int $offset
     * @param int $limit
     * @param string $search
     * @param OrderByItem[] $sort
     * @return mixed
     */
    public function getAll($offset = 0, $limit = self::LIMIT, $search = '', $sort = []);
    public function count($search = '');
    public function get($id);
    public function delete($id);
    public function create(array $details);
    public function update($id, array $details);
}