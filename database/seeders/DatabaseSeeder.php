<?php

namespace Database\Seeders;
use App\Enums\RoleEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use  App\Models\User;



class DatabaseSeeder extends Seeder
{  
   use HasFactory;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $this->call(RoleSeeder::class);
        $teacherRole = Role::firstWhere('name' , RoleEnum::TEACHER->value);
        
        User::factory(9)
        ->create()
        ->each(
            fn(User $user) => $user->assignRole($teacherRole)
        );

       

       User::factory()->create([
            'name' => 'Super Admin',
           'email' => 'admin@example.com',
         ])
          ->assignRole(Role::firstWhere('name' , RoleEnum::SUPER_ADMIN->value))
         ;
         
         $studentRole = Role::firstWhere('name' , RoleEnum::STUDENT->value);

         User::factroy(10)
         ->has(
            studentCard::factory(),
         )

         ->create()
         ->each(
            fn (User $user)=> $user->assignRole($studentRole),
         )
         ;
    }
}
