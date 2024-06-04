<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @param $user
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => hash::make('12345678'),
            'remember_token' => Str::random(10),
        ];

    }

    public function admin($admin = ''): Factory
    {
        return $this->state(function ($attributes) use ($admin) {
            return [
                'email'=> $admin.'@gmail.com',
                'name'=>$admin
            ];
        })->afterCreating(function (User $user) {
            $user->roles()->attach(Role::find(1));
            Folder::create([
                'is_root'=>true,
                'name'=>'root',
                'user_id'=>$user->id
            ]);
        });
    }

    public function user() : Factory
    {
        return $this->state(function ($attributes) {
            return $attributes;
        })->afterCreating(function (User $user) {
            $user->roles()->attach(Role::find(2));
        });
    }



    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
