<?php

namespace App\Repositories;


use App\Models\User;
use App\Structure\OrderByItem;
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


    public function getAll($offset = 0, $limit = self::LIMIT, $search = '', $sort = [])
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
        /** @var OrderByItem $sortItem */
        foreach ($sort as $sortItem) {
            $query->orderBy($sortItem->getColumn(), $sortItem->getDirection());
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

}