<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Processos;

class SIFSeeder extends Seeder
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
            'nome'       => '01. Manutenção das Instalações Industriais, Iluminação, Ventilação, Águas residuais,
            Calibração',
            'documento'  => 'PAC 01',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 2,
            'nome'       => '02. Água de abastecimento',
            'documento'  => 'PAC 02',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 3,
            'nome'       => '03. Controle integrado de pragas',
            'documento'  => 'PAC 03',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 4,
            'nome'       => '04. Programa escrito de Higiene industrial e operacional',
            'documento'  => 'PAC 04',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 5,
            'nome'       => '05. Higiene e hábitos higiênicos dos funcionários',
            'documento'  => 'PAC 05',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 6,
            'nome'       => '06. Procedimentos sanitários operacionais',
            'documento'  => 'PAC 06',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 7,
            'nome'       => '07. Controle da matéria-prima (inclusive aquelas destinadas ao aproveitamento
            condicional), ingrediente e material de embalagem',
            'documento'  => 'PAC 07',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 8,
            'nome'       => '08. Controle de temperaturas',
            'documento'  => 'PAC 08',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 9,
            'nome'       => '09. Programa escrito de Análise de Perigos e Pontos Críticos de Controle',
            'documento'  => 'PAC 09',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 10,
            'nome'       => '10. Análises laboratoriais (Programas de autocontrole, atendimento de requisitos
            sanitários específicos de certificação ou exportação)',
            'documento'  => 'PAC 10',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 11,
            'nome'       => '11. Controle de formulação de produtos e combate à fraude',
            'documento'  => 'PAC 11',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 12,
            'nome'       => '12. Rastreabilidade e recolhimento',
            'documento'  => 'PAC 12',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
            ['id'        => 13,
            'nome'       => '13. Respaldo para certificação oficial',
            'documento'  => 'PAC 13',
            'ativo'      => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],
        ]);
    }
}
