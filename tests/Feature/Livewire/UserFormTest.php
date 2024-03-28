<?php

namespace Tests\Feature;

use Livewire\Livewire;
use App\Livewire\UserForm;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFormTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_user_form_page_contains_livewire_component(): void
    {
        $this->get('/')->assertSeeLivewire('user-form');
    }

    public function test_creates_user_successfully(): void
    {
        $faker = \Faker\Factory::create();
        Livewire::test(UserForm::class)
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('address', $this->faker->streetAddress())
            ->set('city', $this->faker->city())
            ->set('country', $this->faker->country())
            ->set('dobDay', 1)
            ->set('dobMonth', 5)
            ->set('dobYear', 1994)
            ->set('currentPage', 2)
            ->set('married', 1)
            ->set('marriageDateDay', 1)
            ->set('marriageDateMonth', 1)
            ->set('marriageDateYear', 2014)
            ->set('countryOfMarriage', $this->faker->country())
            ->call('submit')
            ->assertRedirect('/users/1');

        $this->assertTrue(User::where('firstName', 'John')->exists());
    }

    public function test_married_attrs_required(): void
    {
        $faker = \Faker\Factory::create();
        Livewire::test(UserForm::class)
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('address', $this->faker->streetAddress())
            ->set('city', $this->faker->city())
            ->set('country', $this->faker->country())
            ->set('dobDay', 1)
            ->set('dobMonth', 5)
            ->set('dobYear', 1994)
            ->set('currentPage', 2)
            ->set('married', '1')
            ->call('submit')
            ->assertHasErrors([
                'marriageDateDay' => 'required',
                'marriageDateMonth' => 'required',
                'marriageDateYear' => 'required',
                'countryOfMarriage' => 'required'
            ]);
    }

    public function test_unmarried_attrs_required(): void
    {
        $faker = \Faker\Factory::create();
        Livewire::test(UserForm::class)
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('address', $this->faker->streetAddress())
            ->set('city', $this->faker->city())
            ->set('country', $this->faker->country())
            ->set('dobDay', 1)
            ->set('dobMonth', 5)
            ->set('dobYear', 1994)
            ->set('currentPage', 2)
            ->set('married', '0')
            ->call('submit')
            ->assertHasErrors([
                'isWidowed' => 'required',
                'wasMarriedBefore' => 'required'
            ]);
    }

    public function test_valid_marriage_date(): void
    {
        $faker = \Faker\Factory::create();
        Livewire::test(UserForm::class)
            ->set('firstName', 'John')
            ->set('lastName', 'Doe')
            ->set('address', $this->faker->streetAddress())
            ->set('city', $this->faker->city())
            ->set('country', $this->faker->country())
            ->set('dobDay', 1)
            ->set('dobMonth', 5)
            ->set('dobYear', 1994)
            ->set('currentPage', 2)
            ->set('married', '1')
            ->set('marriageDateDay', 1)
            ->set('marriageDateMonth', 1)
            ->set('marriageDateYear', 2000)
            ->set('countryOfMarriage', $this->faker->country())
            ->call('submit')
            ->assertHasErrors([
                'marriageDate' => 'You are not eligible to apply because your marriage occurred before your 18th birthday.'
            ]);

        $this->assertFalse(User::where('firstName', 'John')->exists());
    }

    public function test_attributes_required(): void
    {
        $faker = \Faker\Factory::create();
        Livewire::test(UserForm::class)
            ->set('firstName', 'John')
            ->call('submit')
            ->assertHasErrors([
                'lastName' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required'
            ]);
    }
}
