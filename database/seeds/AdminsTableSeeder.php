<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Milos Djokic',
                'email' => 'mdjokic@ztech.io',
            ],
            [
                'name' => 'Ninoslav Stojcic',
                'email' => 'nstojcic@ztech.io',
            ],
            [
                'name' => 'Leta Pavlovic',
                'email' => 'lpavlovic@ztech.io',
            ],
            [
                'name' => 'Milica Dundic',
                'email' => 'mdundic@ztech.io',
            ]
        ];

        foreach( $admins as $admin )
        {
            $row = new Admin();
            $row->name = $admin['name'];
            $row->email = $admin['email'];
            $row->password = bcrypt('password');
            $row->save();
        }

    }
}
