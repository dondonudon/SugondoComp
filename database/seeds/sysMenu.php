<?php

use Illuminate\Database\Seeder;

class sysMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\sysMenu::create([
            'id_group' => 1,
            'segment_name' => 'menu-group',
            'name' => 'Menu Group',
            'url' => 'system-utility/menu-group',
            'ord' => 1,
        ]);
        \App\sysMenu::create([
            'id_group' => 1,
            'segment_name' => 'menu',
            'name' => 'Menu',
            'url' => 'system-utility/menu',
            'ord' => 2,
        ]);

        \App\sysMenu::create([
            'id_group' => 2,
            'segment_name' => 'user-management',
            'name' => 'User Management',
            'url' => 'master-data/user-management',
            'ord' => 1,
        ]);
        \App\sysMenu::create([
            'id_group' => 2,
            'segment_name' => 'user-profile',
            'name' => 'User Profile',
            'url' => 'master-data/user-profile',
            'ord' => 2,
        ]);
    }
}
