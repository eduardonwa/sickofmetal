<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /** @var \App\Models\User $adminUser */

        \App\Models\Post::factory(10)->create();

        // Create admin user
        $adminUser = User::factory()->create([
            'email' => 'admin@correo.com',
            'name' => 'Admin',
            'password' => bcrypt('admin123')
        ]);

        // assign admin role
        $adminRole = Role::create(['name' => 'admin']);
        $adminUser->assignRole($adminRole);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
