<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(sysMenu::class);
        $this->call(sysMenuGroup::class);
        $this->call(sysUser::class);
        $this->call(sysUserProfile::class);
        $this->call(sysPermission::class);
    }
}
