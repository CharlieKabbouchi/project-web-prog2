<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminInsertion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            "id"=>"A2023112","firstName"=>"Abbas","lastName"=>"Zreik","isSuper"=>1,"Gender"=>"Male","salary"=>200,"email"=>"A2023112@gmail.com","password"=>Hash::make("Absrtf12"),]);
    }
}
