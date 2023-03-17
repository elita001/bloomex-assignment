<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsCreated()
    {
        parent::setUp();
        $user = User::factory()->create();
        $userFromDb = User::select('id')->first();
        $this->assertEquals($user->id, $userFromDb->id);
    }

    public function testUserIsUpdated()
    {
        parent::setUp();
        $user = User::factory()->create();
        $userId = $user->id;
        $faker = fake();
        $firstName = $faker->firstName();
        $lastName = $faker->firstName();
        $email = $faker->email();
        $user->update([
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
        ]);
        $updatedUser = User::find($userId);
        $this->assertEquals($updatedUser->firstname, $firstName);
        $this->assertEquals($updatedUser->lastname, $lastName);
        $this->assertEquals($updatedUser->email, $email);
    }
}
