<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $adminRole = Role::create(['name' => 'Administrator']);

        $adminUser = User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $adminUser->assignRole($adminRole);

        $teacherRole = Role::create(['name' => 'Teacher']);

        $teacher = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $teacher->assignRole($teacherRole);

        $studentRole = Role::create(['name' => 'Student']);

        $student = User::create([
            'name' => 'Student',
            'email' => 'student@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $student->assignRole($studentRole);
    }
}
