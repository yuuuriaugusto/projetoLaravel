<?php

// session_start();

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\EmpresasController;
use App\Empresas;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $segmento = $_SESSION["segmento"];
        $fiscalizacao = $_SESSION["fiscalizacao"];
        if($segmento == 1){
            if($fiscalizacao == 1){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIFSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 2){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 3){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIMSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 4){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SISBSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 5){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SELOARTESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 6){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(IN77Seeder::class);
                $this->call(InterdicoesSeeder::class);
            }
        }
        else if($segmento == 2){
            if($fiscalizacao == 1){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIFSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 2){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 3){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIMSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 4){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SISBSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 5){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SELOARTESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 6){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(IN77Seeder::class);
                $this->call(InterdicoesSeeder::class);
            }
        }
        else if($segmento == 3){
            if($fiscalizacao == 1){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIFSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 2){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 3){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIMSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 4){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SISBSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 5){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SELOARTESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 6){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(IN77Seeder::class);
                $this->call(InterdicoesSeeder::class);
            }
        }
        else if($segmento == 4){
            if($fiscalizacao == 1){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIFSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 2){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 3){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SIMSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 4){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SISBSeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 5){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(SELOARTESeeder::class);
                $this->call(InterdicoesSeeder::class);
            }
            else if($fiscalizacao == 6){
                $this->call(UsersTableSeeder::class);
                $this->call(PermissoesTableSeeder::class);
                $this->call(IN77Seeder::class);
                $this->call(InterdicoesSeeder::class);
            }
        }
        // $this->call(UsersTableSeeder::class);
        // $this->call(PermissoesTableSeeder::class);
        // $this->call(SIFSeeder::class);
        // $this->call(InterdicoesSeeder::class);
    }
}
