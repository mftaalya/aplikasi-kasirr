<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        //truncate untuk mengonsongkan data yang ada di dalam table
        User::create([
            'name'=>'Admin',
            'level'=>'admin',
            'email'=>'admin@mail.com',
            'password'=>bcrypt('admin123'),
            'remember_token'=>Str::random(60)
        ]);

        User::create([
            'name'=>'Kasir',
            'level'=>'kasir',
            'email'=>'kasir@mail.com',
            'password'=>bcrypt('kasir123'),
            'remember_token'=>Str::random(60)
        ]);
    }
}
