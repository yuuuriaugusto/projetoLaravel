<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Processos;

class SIMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('processos')->insert([
            ['id'        => 1,
            'nome'       => '01.',
            'documento'  => 'PAC 01',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 2,
            'nome'       => '02.',
            'documento'  => 'PAC 02',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 3,
            'nome'       => '03.',
            'documento'  => 'PAC 03',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 4,
            'nome'       => '04.',
            'documento'  => 'PAC 04',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 5,
            'nome'       => '05.',
            'documento'  => 'PAC 05',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 6,
            'nome'       => '06.',
            'documento'  => 'PAC 06',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 7,
            'nome'       => '07.',
            'documento'  => 'PAC 07',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 8,
            'nome'       => '08.',
            'documento'  => 'PAC 08',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 9,
            'nome'       => '09.',
            'documento'  => 'PAC 09',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 10,
            'nome'       => '10.',
            'documento'  => 'PAC 10',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 11,
            'nome'       => '11.',
            'documento'  => 'PAC 11',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 12,
            'nome'       => '12.',
            'documento'  => 'PAC 12',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 13,
            'nome'       => '13.',
            'documento'  => 'PAC 13',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
        ]);
    }
}
