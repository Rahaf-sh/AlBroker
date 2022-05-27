<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Seeder;

class CargoTypeTableSeederSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
         
       
                'name_en'=>"text1",
                'name_ar'=>"text1",
            ],
            [
         
       
                'name_en'=>"text2",
                'name_ar'=>"text2",
            ],
            
        ];

         CargoType::query()->insert($data);
    }
}
