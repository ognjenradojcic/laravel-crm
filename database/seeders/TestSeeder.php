<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        Permission::create(['name' => 'manageClients']);
        Permission::create(['name' => 'viewClients']);
        Permission::create(['name' => 'manageUsers']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'User']);
        $role1->givePermissionTo('viewClients');

        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('manageClients');
        $role2->givePermissionTo('viewClients');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => Hash::make("test")
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' =>Hash::make("admin")
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make("superAdmin")
        ]);
        $user->assignRole($role3);

        DB::table('companies') -> insert([
            'name' => "Google",
            'email' => "google@example.com",
            'number' => "064212312",
            'address' => "Bulevar",
            'industry' => "IT",
            'eid' => "938231"
        ]);

        DB::table('companies') -> insert([
            'name' => "Amazon",
            'email' => "amazon@example.com",
            'number' => "064987321",
            'address' => "Example",
            'industry' => "Sales",
            'eid' => "485213"
        ]);

        DB::table('companies') -> insert([
            'name' => "Netflix",
            'email' => "netflix@example.com",
            'number' => "062001122",
            'address' => "Demo",
            'industry' => "Streaming",
            'eid' => "632123"
        ]);

        // Create clients

        DB::table('clients') -> insert([
            'name' => "Fake",
            'email' => "fake@example.com",
            'number' => "065123123",
            'address' => "Bulevar",
            'industry' => "IT",
            'company_id' => 1
        ]);

        DB::table('clients') -> insert([
            'name' => "Example",
            'email' => "example@example.com",
            'number' => "065000111",
            'address' => "Example",
            'industry' => "Sales",
            'company_id' => 2
        ]);

        DB::table('clients') -> insert([
            'name' => "Demo",
            'email' => "demo@example.com",
            'number' => "064333222",
            'address' => "Demo",
            'industry' => "Marketing",
            'company_id' => 1
        ]);
        DB::table('clients') -> insert([
            'name' => "Testing",
            'email' => "test@example.com",
            'number' => "064999666",
            'address' => "Testing",
            'industry' => "QA",
            'company_id' => 3
        ]);
    }
}
