<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\FakeTwoFactorService;
use App\Services\TwoFactorService;
use App\Services\TwoFactorServiceInterface;
use JsonException;
use Tests\TestCase;

class TwoFaTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @throws JsonException
     */
    public function testIndex(): void
    {
        $response = $this->get('/');
        $response->assertViewIs('twoFa.index');
        $response->assertSessionHasNoErrors();
    }

    public function testStore(): void
    {
        $response = $this->post('/', [
            'label'     => 'New Label',
            'username'  => $this->user->username
        ]);
        $response->assertViewIs('twoFa.qrCode');
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

    /**
     * @throws JsonException
     */
    public function testCodeView(): void
    {
        $response = $this->get('/code');
        $response->assertViewIs('twoFa.setCode');
        $response->assertSessionHasNoErrors();
    }

    /**
     * @throws JsonException
     */
    public function testCodeVerification()
    {
        $this->app->bind(TwoFactorServiceInterface::class, FakeTwoFactorService::class);

        $response = $this->post('/code/validate', [
            'username'  => $this->user->username,
            'code'      => 333333
        ]);
        $response->assertSessionHasNoErrors();
    }

    public function testCodeVerificationWrongCode()
    {
        $this->app->bind(TwoFactorServiceInterface::class, FakeTwoFactorService::class);

        $response = $this->post('/code/validate', [
            'username'  => $this->user->username,
            'code'      => 555555
        ]);
        $response->assertSessionHasErrors([
            'code'
        ]);
    }

    public function testCodeVerificationStartsWithZeroIsValid()
    {
        $this->app->bind(TwoFactorServiceInterface::class, FakeTwoFactorService::class);

        $response = $this->post('/code/validate', [
            'username'  => $this->user->username,
            'code'      => 003333
        ]);
        $response->assertSessionHasErrors([
            'code'
        ]);
    }
}
