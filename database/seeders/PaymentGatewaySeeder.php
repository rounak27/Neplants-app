<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       PaymentGateway::create([
           'name'=>'Cash on delivery',
           'code'=>'cod',
       ]);
       PaymentGateway::create([
        'name'=>'Khalti',
        'code'=>'khalti',
    ]);
    }
}
