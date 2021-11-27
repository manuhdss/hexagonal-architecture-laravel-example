<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User as EloquentUser;
use Tests\TestCase;

class UserSignupTest extends TestCase
{
    use RefreshDatabase;

    private string $path;

    private array $mock_data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->path = route('auth.signup');
        $this->mock_data = ['name' => 'Marc', 'email' => 'test@mail.com', 'password' => '1234567'];
    }

    /**
     * Test a POST request to /auth/login creates a new entry into the users table
     */
    public function test_user_can_be_registered()
    {
        $response = $this->post($this->path, $this->mock_data);
        $response->assertStatus(201);
        $this->assertDatabaseCount('users', 1);
    }

    public function test_user_cannot_signup_without_a_valid_email()
    {
        $this->mock_data['email'] = 'bad_email_address';
        $response = $this->post($this->path, $this->mock_data);
        $response->assertStatus(400);
        $response->assertExactJson(['error' => 'Invalid email format']);
    }

    public function test_user_password_has_valid_format()
    {
        $this->mock_data['password'] = 'badPas';
        $response = $this->post($this->path, $this->mock_data);
        $response->assertStatus(400);
        $response->assertExactJson(['error' => 'Password must be longer than 6 characters']);
    }

    private function getSignedUser(): EloquentUser
    {
        return EloquentUser::first();
    }
}
