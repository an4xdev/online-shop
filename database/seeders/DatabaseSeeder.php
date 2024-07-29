<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use App\Models\DeliveryStatus;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory()->create(
            [
                "name" => "admin",
            ]
        );

        Role::factory()->create(
            [
                "name" => "seller",
            ]
        );

        Role::factory()->create(
            [
                "name" => "user",
            ]
        );

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 's1',
            'email' => 's1@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 's2',
            'email' => 's2@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 's3',
            'email' => 's3@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 's4',
            'email' => 's4@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 's5',
            'email' => 's5@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 's6',
            'email' => 's6@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'u1',
            'email' => 'u1@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'u2',
            'email' => 'u2@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'u3',
            'email' => 'u3@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'u4',
            'email' => 'u4@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'u5',
            'email' => 'u5@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'u6',
            'email' => 'u6@example.com',
            'role_id' => 3,
        ]);

        DeliveryStatus::factory()->create([
            'name' => 'Opłacono zamówienie',
        ]);

        DeliveryStatus::factory()->create([
            'name' => 'Przygotowano zamówienie',
        ]);

        DeliveryStatus::factory()->create([
            'name' => 'Wysłano zamówienie',
        ]);

        DeliveryStatus::factory()->create([
            'name' => 'Zamówienie dostarczone',
        ]);

        DeliveryMethod::factory()->create([
            'name' => 'Odbiór osobisty',
            'price' => 0.0
        ]);

        DeliveryMethod::factory()->create([
            'name' => 'Kurier dzisiaj',
            'price' => 29.99
        ]);

        DeliveryMethod::factory()->create([
            'name' => 'Kurier',
            'price' => 16.99
        ]);

        $sql = file_get_contents(database_path('\seeds\data.sql'));
        DB::unprepared($sql);
    }
}
