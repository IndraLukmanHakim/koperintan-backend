<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name" => "Jenniee1",
            "nopol" => "KT1234JR",
            "username" => "cantik",
            "password" => bcrypt("12345678"),
            "point" => 0,
            "phone" => "08123456789",
            "roles" => "ADMIN",
        ]);

        $productCategory = [
            "Makanan",
            "Minuman",
            "Snack",
            "Pakaian",
            "Elektronik",
            "Kosmetik",
            "Lainnya",
        ];
        foreach ($productCategory as $category) {
            ProductCategory::create([
                "name" => $category,
            ]);
        }

        Transaction::create([
            "users_id" => 1,
            "users_phone" => "08123456789",
            "address" => "Jl. Kebon Jeruk No. 1",
            "total_price" => 100000,
            "total_point" => 100000,
            "shipping_price" => 0,
            "status" => "Pending",
            "payment" => "MANUAL",
        ]);
    }
}
