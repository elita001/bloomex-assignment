<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\UserAddress;
use App\Structure\Db\OrderByItem;
use App\Structure\Db\FilterItem;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements RepositoryInterface
{
    public function count($search = '')
    {
        $query = User::with('userAddress')
            ->with('userPhones');
        if ($search) {
            /** @var Builder $query */
            $query->where(function(Builder $query) use($search) {
                $query->where('users.firstname', 'LIKE', "%$search%")
                    ->orWhere('users.lastname', 'LIKE', "%$search%")
                    ->orWhere('users.email', 'LIKE', "%$search%")
                    ->orWhereHas('userAddress', function(Builder $query) use ($search) {
                        $query->where('user_addresses.street', 'LIKE', "%$search%")
                            ->orWhere('user_addresses.city', 'LIKE', "%$search%")
                            ->orWhere('user_addresses.country', 'LIKE', "%$search%")
                            ->orWhere('user_addresses.zip', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('userPhones', function(Builder $query) use ($search) {
                        $query->where('user_phones.phone_number', 'LIKE', "%$search%");
                    });
            });
        }
        return $query->count();
    }


    public function getAll($offset = 0, $limit = self::LIMIT, $search = '', $sort = [], $filter = [])
    {
        if (!$limit) {
            $limit = self::LIMIT;
        }
        $query = User::with('userAddress')
            ->with('userPhones');
        if ($search) {
            /** @var Builder $query */
            $query->where(function(Builder $query) use($search) {
               $query->where('users.firstname', 'LIKE', "%$search%")
                   ->orWhere('users.lastname', 'LIKE', "%$search%")
                   ->orWhere('users.email', 'LIKE', "%$search%")
                   ->orWhereHas('userAddress', function(Builder $query) use ($search) {
                       $query->where('user_addresses.street', 'LIKE', "%$search%")
                           ->orWhere('user_addresses.city', 'LIKE', "%$search%")
                           ->orWhere('user_addresses.country', 'LIKE', "%$search%")
                           ->orWhere('user_addresses.zip', 'LIKE', "%$search%");
                   })
                   ->orWhereHas('userPhones', function(Builder $query) use ($search) {
                       $query->where('user_phones.phone_number', 'LIKE', "%$search%");
                   });
            });
        }
        /** @var OrderByItem $sortItem */
        foreach ($sort as $sortItem) {
            $query->orderBy($sortItem->getColumn(), $sortItem->getDirection());
        }
        /** @var FilterItem $filterItem */
        foreach ($filter as $filterItem) {
            $relation = $filterItem->getRelation();
            if ($relation) {
                $query->whereHas(
                    $filterItem->getRelation(),
                    function (Builder $query) use ($filterItem) {
                        $query->where($filterItem->getColumn(), $filterItem->getOperator(), $filterItem->getValue());
                    }
                );
                continue;
            }
            $query->where($filterItem->getColumn(), $filterItem->getOperator(), $filterItem->getValue());
        }
        return $query->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param array $details
     * @return mixed
     */
    public function create(array $details)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $id
     * @param array $details
     * @return mixed
     */
    public function update($id, array $details)
    {
        // TODO: Implement update() method.
    }

    public function getCountries() {
        return UserAddress::select('country')->orderBy('country')->distinct(true)->pluck('country');
    }
}