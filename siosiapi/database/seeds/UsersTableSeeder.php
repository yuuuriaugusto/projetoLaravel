<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nome'      => 'admin',
            'email'     => 'admin',
            'password'  => bcrypt('12345Siosi'),
            'ativo'     => '1',
        ]);
    }
}