<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    public UserRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new UserRepository(new User());
    }

    public function testGetValidUserByUsername()
    {
        $user = User::factory()->create();

        $model = $this->repository->getUserByUsername($user->username);
        $this->assertInstanceOf(User::class, $model);
        $this->assertEquals($user->username, $model->username);
    }

    public function testThrowsModelNotFoundForInvalidUsername()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository->getUserByUsername('aaa');
    }
}
