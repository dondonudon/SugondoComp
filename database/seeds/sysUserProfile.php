<?php

use Illuminate\Database\Seeder;

class sysUserProfile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\sysUserProfile::create([
            'username' => 'dev',
            'full_name' => 'Developer',
            'email' => 'contact@wave.com',
            'phone' => '02476435251'
        ]);
    }
}
