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
            'name' => 'seller1',
            'email' => 'seller1@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'seller2',
            'email' => 'seller2@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'seller3',
            'email' => 'seller3@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'seller4',
            'email' => 'seller4@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@example.com',
            'role_id' => 3,
        ]);

        User::factory()->create([
            'name' => 'user4',
            'email' => 'user4@example.com',
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

        // $sql = file_get_contents(database_path('\seeds\data.sql'));
        // DB::unprepared($sql);
    }
}
