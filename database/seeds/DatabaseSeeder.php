<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'=>'Administrator',
                'description'=>'Super User',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'name'=>'User',
                'description'=>'Normal User',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ]);

        DB::table('users')->insert([
            [
                'role_id'=>1,
                'first_name'=>'Eriq John',
                'last_name'=>'Mendoza',
                'email'=>'admin@admin.com',
                'password' => bcrypt('qweasd'), 
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

        ]);

    }
}
