<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Store::create([
            'title' => 'Store 1',
            'phone' => '0655555555',
            'neighborhood' => 'neighborhood 1',
            'image' => 'image 1',
            'status' => 1,
            'user_id' => 2,
            'city_id' => 1,
        ]);
    }
}