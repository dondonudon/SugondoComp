<?php

use Illuminate\Database\Seeder;

class sysMenuGroup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\sysMenuGroup::create([
            'segment_name' => 'system-utility',
            'name' => 'System Utility',
            'icon' => 'fas fa-code',
            'ord' => 1,
        ]);

        \App\sysMenuGroup::create([
            'segment_name' => 'master-data',
            'name' => 'User Management',
            'icon' => 'fas fa-code',
            'ord' => 2,
        ]);
    }
}
