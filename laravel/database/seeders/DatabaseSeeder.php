<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Products;
use App\Models\Billing;
use App\Models\Order_items;
use App\Models\Orders;
use App\Models\Images;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        Products::factory(20)->create();
        Billing::factory(10)->create();
        Order_items::factory(40)->create();
        Orders::factory(2)->create();
        Images::factory(10)->create();

    }
}
