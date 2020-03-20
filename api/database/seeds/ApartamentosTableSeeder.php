<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApartamentosTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('apartamentos')->insert([
            'predio_id' => 1,
            'finalidade_id' => 1,
            'numero' => '101',
            'andar' => '1º',
            'quartos' => '2',
            'banheiros' => '1',
            'metros' => '75',
            'status' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 1,
            'finalidade_id' => 2,
            'numero' => '102',
            'andar' => '1º',
            'quartos' => '2',
            'banheiros' => '1',
            'metros' => '75',
            'status' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 1,
            'finalidade_id' => 2,
            'numero' => '202',
            'andar' => '2º',
            'quartos' => '4',
            'banheiros' => '3',
            'metros' => '140',
            'status' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 2,
            'finalidade_id' => 1,
            'numero' => '101',
            'andar' => '1º',
            'quartos' => '3',
            'banheiros' => '1',
            'metros' => '240',
            'status' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 2,
            'finalidade_id' => 1,
            'numero' => '201',
            'andar' => '2º',
            'quartos' => '3',
            'banheiros' => '1',
            'metros' => '240',
            'status' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 2,
            'finalidade_id' => 2,
            'numero' => '301',
            'andar' => '3º',
            'quartos' => '4',
            'banheiros' => '2',
            'metros' => '240',
            'status' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 2,
            'finalidade_id' => 2,
            'numero' => '401',
            'andar' => '4º',
            'quartos' => '4',
            'banheiros' => '2',
            'metros' => '240',
            'status' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('apartamentos')->insert([
            'predio_id' => 2,
            'finalidade_id' => 2,
            'numero' => '501',
            'andar' => '5º',
            'quartos' => '4',
            'banheiros' => '2',
            'metros' => '240',
            'status' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
