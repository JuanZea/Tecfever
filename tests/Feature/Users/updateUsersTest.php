<?php

namespace Tests\Feature\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class updateUsersTest extends TestCase
{
    use RefreshDatabase;

    private $valid_users_request;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->valid_users_request = factory(User::class)->raw();
    }

    /**
     * Verify that an admin can update users with valid information
     *
     * @test
     * @dataProvider validUserInputDataProvider
     * @param string $data
     */
    public function anAdminCanUpdateUsersWithValidUserInputs(string $data)
    {
        // Arrange
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $user = factory(User::class)->create();
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $oldData = TestHelpers::removeTimeKeys($user->toArray());
        $validRequest = $this->valid_users_request;

        if($data == 'same') {
            $validRequest = $oldData;
        }
        if ($data != 'new' && $data != 'same') {
            $validRequest[$data] = $oldData[$data];
        }

        // Act
        $this->actingAs($admin);
        $response = $this->put(route('users.update', $user), $validRequest);

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('users', $validRequest);
        // Asserts - New Data
        if ($data == 'new') {
            $this->assertDatabaseMissing('users', $oldData);
        }
    }

    /**
     * Verify that a user can update their information with valid information
     *
     * @test
     */
    public function anUserCanUpdateTheirInformationWithValidInformation()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $validRequest = $this->valid_users_request;

        // Act
        $this->actingAs($user);
        $response = $this->patch(route('users.update', $user), $validRequest);

        // Assert
        $response->assertRedirect(route('account'));
        $this->assertDatabaseHas('users', $validRequest);
    }

    /**
     * Verify that an admin cannot update users with invalid information
     *
     * @test
     * @dataProvider invalidUserInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateUsersWithInvalidUserInputs(string $field, ?string $value)
    {
        // Arrange
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($admin);
        $invalidRequest = TestHelpers::VALIDREQUESTFORUSER;
        $invalidRequest[$field] = $value;
        if($value == 'nixon@admin.com'){
            $invalidRequest[$field] = $admin->email;
        }
        $response = $this->put(route('users.update',$user),$invalidRequest);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('users',$invalidRequest);
    }

    //PROVIDERS

    public function validUserInputDataProvider()
    {
        return [
            'New data' => ['new'],
            'Same data' => ['same'],
            'Same name' => ['name'],
            'same email' => ['email'],
            'Same is_enabled status' => ['is_enabled']
        ];
    }

    public function invalidUserInputDataProvider()
    {
        return [
            'No name' => ['name', null],
            'A name too short' => ['name', Str::random(1)],
            'A name too large' => ['name', Str::random(41)],
            'No email' => ['name', null],
            'A email too large' => ['email', Str::random(60) . '@test.com'],
            'A repeated email' => ['email', 'nixon@admin.com'],
            'Email is not an email' => ['email', Str::random(29)]
        ];
    }
}