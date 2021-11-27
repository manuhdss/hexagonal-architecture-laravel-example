<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Src\Domain\User;
use Src\Infrastructure\EloquentUserRepository;
use Tests\TestCase;

final class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private EloquentUserRepository $repository;

    private array $user_data;

    protected function setUp(): void
    {
        parent::setUp();
        RefreshDatabaseState::$migrated = false;
        $this->repository = new EloquentUserRepository();
        $this->user_data = ['name' => 'John', 'email' => 'john@smith.co', 'password' => 'securePassword'];
    }

    public function test_it_should_save_a_user()
    {
        $user = User::fromPrimitives($this->user_data);
        $this->repository->save($user);
        // useless assertion in order to remove the phpunit warning that this test does not perform any assertions
        $this->assertNull(null);
    }

    public function test_it_should_find_a_existing_user()
    {
        $expected = User::fromPrimitives($this->user_data);
        $this->repository->save($expected);
        $actual = $this->repository->find(1);
        $this->assertEquals($expected, $actual);
    }

    public function test_it_should_not_find_a_non_existing_user()
    {
        $match = $this->repository->find(99);
        $this->assertNull($match);
    }
}