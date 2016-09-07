<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(array('name'=>'Cell Phone', 'stock'=>'2', 'price'=>'150'));
        Product::create(array('name'=>'Mouse', 'stock'=>'3', 'price'=>'200'));
    }
}
