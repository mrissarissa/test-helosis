<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Beras',
            'price' => 59000,
            'description' => 'Beras Ramos',
      ]);
        Product::create([
            'name' => 'Gula',
            'price' => 21000,
            'description' => 'Gula 1kg',
      ]);
        Product::create([
            'name' => 'Minyak',
            'price' => 45000,
            'description' => 'Minyak 2 Lt',
      ]);
    }
}
