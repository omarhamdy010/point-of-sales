<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class clientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['omar','mohamed','ahmed'];
        foreach ($clients as $client){
            Client::create([
                'name'=>$client ,
                'address'=>'this is address',
                'phone'=>'01022781283',
                'phone'=>'01022781283',
            ]);
        }
    }
}
