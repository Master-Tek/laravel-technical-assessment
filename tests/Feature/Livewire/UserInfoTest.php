<?php

namespace Tests\Feature;

use Livewire\Livewire;
use App\Livewire\UsersInfo;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class UserInfoTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_users_info_page_contains_livewire_component(): void
    {
        $user = User::factory()->create();
        $this->get("/users/{$user->id}")->assertSeeLivewire('users-info');
    }

    public function test_married_user_info_data_passed_correctly(): void
    {
        $user = User::factory()->married()->create();

        $dateOfBirth = Carbon::parse($user->dateOfBirth)->format('d-m-Y');
        $dateOfMarriage = Carbon::parse($user->dateOfMarriage)->format('d-m-Y');
        Livewire::test(UsersInfo::class, ['id' => $user->id])
            ->assertSet('user', User::findOrFail($user->id))
            ->assertSeeHtml("<h2>User Information</h2>")
            ->assertSeeHtml("<strong>First name:</strong> {$user->firstName}")
            ->assertSeeHtml("<strong>Last name:</strong> {$user->lastName}")
            ->assertSeeHtml("<strong>Address:</strong> {$user->address}")
            ->assertSeeHtml("<strong>City:</strong> {$user->city}")
            ->assertSeeHtml("<strong>Country:</strong> {$user->country}")
            ->assertSeeHtml("<strong>Date of birth:</strong> {$dateOfBirth}")
            ->assertSeeHtml("<strong>Married:</strong> Yes")
            ->assertSeeHtml("<strong>Date of marriage:</strong> {$dateOfMarriage}")
            ->assertSeeHtml("<strong>Country of marriage:</strong> {$user->countryOfMarriage}")
            ->assertDontSeeHtml("<strong>Widowed:</strong> Yes")
            ->assertDontSeeHtml("<strong>Married before:</strong> Yes");
    }

    public function test_unmarried_user_info_data_passed_correctly(): void
    {
        $user = User::factory()->unmarried()->create();

        $dateOfBirth = Carbon::parse($user->dateOfBirth)->format('d-m-Y');
        $dateOfMarriage = Carbon::parse($user->dateOfMarriage)->format('d-m-Y');
        Livewire::test(UsersInfo::class, ['id' => $user->id])
            ->assertSet('user', User::findOrFail($user->id))
            ->assertSeeHtml("<h2>User Information</h2>")
            ->assertSeeHtml("<strong>First name:</strong> {$user->firstName}")
            ->assertSeeHtml("<strong>Last name:</strong> {$user->lastName}")
            ->assertSeeHtml("<strong>Address:</strong> {$user->address}")
            ->assertSeeHtml("<strong>City:</strong> {$user->city}")
            ->assertSeeHtml("<strong>Country:</strong> {$user->country}")
            ->assertSeeHtml("<strong>Date of birth:</strong> {$dateOfBirth}")
            ->assertSeeHtml("<strong>Married:</strong> No")
            ->assertSeeHtml("<strong>Widowed:</strong> Yes")
            ->assertSeeHtml("<strong>Married before:</strong> Yes")
            ->assertDontSeeHtml("<strong>Date of marriage:</strong> {$dateOfMarriage}")
            ->assertDontSeeHtml("<strong>Country of marriage:</strong> {$user->countryOfMarriage}");
    }
}
