<?php

namespace Database\Seeders;
use App\Models\customer;

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        customer::factory()->count(10)->create();
    
    /*    customer::factory()
        ->count(25)
        ->hasInvoices(10)
        ->create();

        customer::factory()
        ->count(100)
        ->hasInvoices(5)
        ->create();
        customer::factory()
        ->count(100)
        ->hasInvoices(10)
        ->create();

        customer::factory()
        ->count(5)
        ->create();
        */
    }
}
