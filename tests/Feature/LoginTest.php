<?php

namespace Tests\Feature;

use App\Models\User;
use JsonException;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        $this->user = User::factory()->create();
    }

    /**
     * @throws JsonException
     */
    public function testIndex(): void
    {
        $response = $this->get('/');
        $response->assertViewIs('login.index');
        $response->assertSessionHasNoErrors();
    }

    public function testStore(): void
    {
        $response = $this->post('/', [
            'label'     => 'New Label',
            'username'  => $this->user->username
        ]);
        $response->assertViewIs('login.qrCode');
        $response->assertViewHas('label', 'New Label');
        $response->assertViewHas('username', $this->user->username);
        $response->assertSee('<svg', false);
    }

    public function testStoreWrongUsername(): void
    {
        $response = $this->post('/', [
            'label'     => 'New Label',
            'username'  => 'test UsErname'
        ]);

        $response->assertSessionHasErrors(['username']);
    }

    public function testStoreEmptyInputs(): void
    {
        $response = $this->post('/', [
            'label'     => '',
            'username'  => ''
        ]);

        $response->assertSessionHasErrors(['label', 'username']);
    }

    public function testStoreEmptyLabel(): void
    {
        $response = $this->post('/', [
            'label'     => '',
            'username'  => $this->user->username
        ]);

        $response->assertSessionHasErrors(['label']);
    }

    public function testStoreEmptyUsername(): void
    {
        $response = $this->post('/', [
            'label'     => 'laaabeeeel',
            'username'  => ''
        ]);

        $response->assertSessionHasErrors(['username']);
    }
}
