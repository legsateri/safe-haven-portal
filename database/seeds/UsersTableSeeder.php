<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Milos',
                'last_name' => 'Djokic',
                'email' => 'mdjokic@ztech.io',
                'type' => 'shelter',
            ],
            [
                'first_name' => 'Milos',
                'last_name' => 'Djokic',
                'email' => 'milos.djokic@ztech.io',
                'type' => 'advocate',
            ],
            [
                'first_name' => 'Ninoslav',
                'last_name' => 'Stojcic',
                'email' => 'nstojcic@ztech.io',
                'type' => 'shelter',
            ],
            [
                'first_name' => 'Leta',
                'last_name' => 'Pavlovic',
                'email' => 'lpavlovic@ztech.io',
                'type' => 'advocate',
            ],
            [
                'first_name' => 'Milica',
                'last_name' => 'Dundic',
                'email' => 'mdundic@ztech.io',
                'type' => 'shelter',
            ]
        ];

        foreach ( $users as $user )
        {
            $row = new User();
            $row->first_name = $user['first_name'];
            $row->last_name = $user['last_name'];
            $row->slug = str_slug($user['first_name'] . ' ' . $user['last_name'], '-');
            $row->email = $user['email'];
            $row->password = bcrypt('password');
            $row->type = $user['type'];
            $row->activated = true;
            $row->save();
        }

    }
}
