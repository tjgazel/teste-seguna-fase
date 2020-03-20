<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PrediosTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('predios')->insert([
            'nome' => 'Vitória',
            'logradouro' => 'Rua Epaminondas Otonni',
            'numero' => 1023,
            'bairro' => 'Centro',
            'cidade' => 'Teófilo Otoni',
            'estado' => 'MG',
            'cep' => '39800013',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('predios')->insert([
            'nome' => 'Cidade das Pedras',
            'logradouro' => 'Av. Getúlio Vargas',
            'numero' => 567,
            'bairro' => 'Centro',
            'cidade' => 'Teófilo Otoni',
            'estado' => 'MG',
            'cep' => '39800015',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
