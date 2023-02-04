<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPhone;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = 100;
        User::factory($usersCount)
            ->create()
            ->each(function($user) {
                // 1 or 0 Addresses
                !mt_rand(0, 1) ?: UserAddress::factory()->create(['user_id' => $user->id]);
                // 1..4 Phone numbers
                UserPhone::factory(mt_rand(1,4))->create(['user_id' => $user->id]);
            });
    }
}
