<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mul_rows= [
            [
              'name' => 'Admin',
              'email' => 'admin@gmail.com',
              'password' => Hash::make('adminpass'),
              'profile' => 'profile.jpeg',
              'type' => '0',
              'phone' => '09977123456',
              'address' => 'Yangon',
              'dob' => '1997/07/22',
              'create_user_id' => '1',
              'updated_user_id' => '1',
            ],
            [
              'name' => 'User',
              'email' => 'user@gmail.com',
              'password' => Hash::make('userpass'),
              'profile' => 'profile.jpeg',
              'type' => '1',
              'phone' => '09977123489',
              'address' => 'Yangon',
              'dob' => '1996/05/21',
              'create_user_id' => '1',
              'updated_user_id' => '1',
            ]
        ];
        foreach ($mul_rows as $rows) {
          $insert= DB::table('users')->insert($rows);
        }
    }
}
