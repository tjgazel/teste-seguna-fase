<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FinalidadesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('finalidades')->insert([
            'descricao' => 'Aluguel'
        ]);

        DB::table('finalidades')->insert([
            'descricao' => 'Venda'
        ]);
    }
}
