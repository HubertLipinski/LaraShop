<?php

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
         $this->call(CategorySeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(CartTableSeeder::class);
         $this->call(VoyagerDatabaseSeeder::class);
         $this->call(ProductTableSeeder::class);
    }
}
