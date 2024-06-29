<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->name, $component->state['name']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        $newData = [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'secondary_email' => 'test2@example.com',
            'address' => '00100 - Test, Kenya',
            'phone' => '+254000000000',
        ];

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', $newData)
            ->call('updateProfileInformation');

        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
        $this->assertEquals('test2@example.com', $user->fresh()->secondary_email);
        $this->assertEquals('00100 - Test, Kenya', $user->fresh()->address);
        $this->assertEquals('+254000000000', $user->fresh()->phone);
    }
}
