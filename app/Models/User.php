<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Get the address associated with the user.
     */
    public function userAddress()
    {
        return $this->hasOne(UserAddress::class);
    }

    /**
     * Get the phone numbers associated with the user.
     */
    public function userPhones()
    {
        return $this->hasMany(UserPhone::class);
    }
}
