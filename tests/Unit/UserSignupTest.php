<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Application\UserSignup;
use Src\Domain\User;
use Src\Domain\User\UserEmail;
use Src\Domain\User\UserName;
use Src\Domain\User\UserPassword;
use Src\Domain\UserRepository;

class UserSignupTest extends TestCase
{
    private UserRepository $user_repository;

    private User $mock_user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user_repository = $this->createMock(UserRepository::class);
        $this->mock_user = new User(
            new UserName('Fran'),
            new UserEmail('fran@secret.com'),
            new UserPassword('my_pass')
        );
    }

    /**
     * Test the user is saved into the repository
     */
    public function test_user_is_saved_into_the_repository(): void
    {
        $this->user_repository
            ->expects($this->once())
            ->method('save')
            ->with($this->mock_user);

        $user_signup = new UserSignup($this->user_repository);
        $user_signup->signup($this->mock_user);
    }
}
