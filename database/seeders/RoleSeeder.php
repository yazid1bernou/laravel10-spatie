<?php

namespace Database\Seeders;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(RoleEnum::cases() as $roleEnum ) {
            Role::create([
                'name' => $roleEnum->value,
            ]);
        }

            (Permission::create([
                'name' => 'student-cards.*'
            ]))->assignRole(
                Role::firstWhere('name' , RoleEnum::TEACHER->value),
            );
    }
}
