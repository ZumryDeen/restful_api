<?php

use Illuminate\Database\Seeder;

class add_demo_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Demo User',
            'email' => 'test@fixico.com',
            'password' => bcrypt('test'),
        ]);

    }
}
