<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name'          => 'Romel Indemne',
            'email'         => 'admin@admin.com',
            'password'      => Hash::make('aAwWsSdD1%1'),
            'phone'         => '05012345678',
            'role'          => 1,
            'status'        => true,
            'company_id'    => 1,
        ]);
        $user->save(); 
    }
}
