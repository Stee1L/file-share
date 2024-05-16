<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory(2)->state(new Sequence(['name'=>'Администратор', 'slug'=>'Самый главный'], ['name'=>'Пользователь', 'slug'=>'Не самый главный']))->create();
    }
}
