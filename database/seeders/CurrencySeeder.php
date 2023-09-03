<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name'       => 'يورو',
                'name_en'    => 'EUR',
                'code'       => '978',
                'created_at' => now(),
            ],
            [
                'name'       => 'دولار أمريكي',
                'name_en'    => 'USD',
                'code'       => '840',
                'created_at' => now(),
            ],
            [
                'name'       => 'دينار أردني',
                'name_en'    => 'JOD',
                'code'       => '400',
                'created_at' => now(),
            ],
        ];

        foreach ( $types as $type )
        {
            DB::table( 'currencies' )->updateOrInsert( [ 'code' => $type['code'] ], $type );
        }
    }
}
