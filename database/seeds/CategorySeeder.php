<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    private $categoryList = [
        'Elektronika',
        'Dom i ogród',
        'Zdrowie',
        'Gadżety',
        'Motoryzacja',
        'Zabawki',
        'Ksiązki',
        'Gry',
        'Filmy',
        'Inne',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categoryList as $name) {
            DB::table('categories')->insert([
                'name' => $name,
                'description' => 'Kategoria '.$name,
            ]);
        }
    }
}
