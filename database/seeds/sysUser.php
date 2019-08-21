<?php

use Illuminate\Database\Seeder;

class sysUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\sysUser::create([
            'username' => 'dev',
            'password' => \Illuminate\Support\Facades\Crypt::encryptString('dev'),
        ]);
    }
}
