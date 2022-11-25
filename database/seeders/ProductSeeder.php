<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Product::upsert([
      [
        'id' => 12,
        'title' => '測試資料',
        'content' => '測試內容',
        'price' => rand(1, 300),
        'quantity' => rand(1, 30)
      ],
      [
        'id' => 13,
        'title' => '測試資料',
        'content' => '測試內容',
        'price' => rand(1, 300),
        'quantity' => rand(1, 30)
      ]
    ], ['id'], ['price', 'quantity']);
  }
}
