<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id' => '1',
            'name' => 'MH Sunny',
            'username' => 'admin',
            'email' => 'mhsunny.abcd@gmail.com',
            'password' => bcrypt('12345678') 
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Yellin Hasan',
            'username' => 'author',
            'email' => 'yellin@gmail.com',
            'password' => bcrypt('12345678') 
        ]);
         
        // $table->bigIncrements('id');
        // $table->integer('role_id')->default(2);
        // $table->string('name');
        // $table->string('username')->unique();
        // $table->string('email')->unique();
        // $table->timestamp('email_verified_at')->nullable();
        // $table->string('password');
        // $table->string('image')->default('default.png');
        // $table->text('about')->nullable();
        // $table->rememberToken();
        // $table->timestamps();


    }
}
