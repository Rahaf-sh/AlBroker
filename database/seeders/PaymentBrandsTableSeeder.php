<?php

namespace Database\Seeders;

use App\Models\PaymentBrands;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Database\Seeder;

class PaymentBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      PaymentBrands::insert([
          [
            "name"=>"MADA",
            "name_ar"=>'مدى',
            "media_path"=>"paymentBrands/mada.png",
          ],

          [
            "name"=>"APPLE PAY",
            "name_ar"=>'أبل باي',
            "media_path"=>"paymentBrands/apple.png",
          ],
          [
            "name"=>"MASTER CARD",
            "name_ar"=>'ماستر كارد',
            "media_path"=>"paymentBrands/master.png",
          ],

          [
            "name"=>"VISA",
            "name_ar"=>'فيزا',
            "media_path"=>"paymentBrands/visa.png",
          ],

      ]);
    }
}
