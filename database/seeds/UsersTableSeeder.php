<?php

use Illuminate\Database\Seeder;

use App\ObjectType;
use App\User;
use App\Organisation;
use App\OrganisationAdmin;
use App\Status;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get user and organisation type ids for advocate and shelter
        $advocateTypeUser = ObjectType::where([
                            ['type', '=', 'user'],
                            ['value', '=', 'advocate']
                        ])->first();

        $shelterTypeUser = ObjectType::where([
                            ['type', '=', 'user'],
                            ['value', '=', 'shelter']
                        ])->first();
        $advocateTypeOrg = ObjectType::where([
                            ['type', '=', 'organisation'],
                            ['value', '=', 'advocate']
                        ])->first();

        $shelterTypeOrg = ObjectType::where([
                            ['type', '=', 'organisation'],
                            ['value', '=', 'shelter']
                        ])->first();
        

        $users = [
            [
                'first_name' => 'Milos',
                'last_name' => 'Djokic',
                'email' => 'mdjokic@ztech.rs',
                'type' => $advocateTypeUser->id,
                'organisation' => [
                    'name' => 'Milos Adv.',
                    'tax_id'=> '11-4845484',
                    'org_type_id' => $advocateTypeOrg->id

                ]
            ],
            [
                'first_name' => 'Milos',
                'last_name' => 'Djokic',
                'email' => 'mdjokic@ztech.io',
                'type' => $shelterTypeUser->id,
                'organisation' => [
                    'name' => 'Milos Shelter',
                    'tax_id'=> '11-5645484',
                    'org_type_id' => $shelterTypeOrg->id

                ]
            ]
            // [
            //     'first_name' => 'Ninoslav',
            //     'last_name' => 'Stojcic',
            //     'email' => 'nstojcic@ztech.rs',
            //     'type' => $advocateTypeUser->id,
            //     'organisation' => [
            //         'name' => 'Nino Adv.',
            //         'tax_id'=> '11-4811484',
            //         'org_type_id' => $advocateTypeOrg->id

            //     ]
            // ],
            // [
            //     'first_name' => 'Ninoslav',
            //     'last_name' => 'Stojcic',
            //     'email' => 'nstojcic@ztech.io',
            //     'type' => $shelterTypeUser->id,
            //     'organisation' => [
            //         'name' => 'Nino Shelter',
            //         'tax_id'=> '11-4845433',
            //         'org_type_id' => $shelterTypeOrg->id

            //     ]
            // ],
            // [
            //     'first_name' => 'Milica',
            //     'last_name' => 'Dundic',
            //     'email' => 'mdundic@ztech.io',
            //     'type' => $advocateTypeUser->id,
            //     'organisation' => [
            //         'name' => 'Milica Adv.',
            //         'tax_id'=> '11-4125484',
            //         'org_type_id' => $advocateTypeOrg->id

            //     ]
            // ],
            // [
            //     'first_name' => 'Milica',
            //     'last_name' => 'Dundic',
            //     'email' => 'mdundic@ztech.rs',
            //     'type' => $shelterTypeUser->id,
            //     'organisation' => [
            //         'name' => 'Milica Shelter',
            //         'tax_id'=> '11-4849874',
            //         'org_type_id' => $shelterTypeOrg->id

            //     ]
            // ]
        ];

        // get active organization status
        $org_status = Status::where([
            ['type', '=', 'organisation'],
            ['value', '=', 'approved']
        ])->first();
        

        foreach ( $users as $user )
        {
            // create organisation
            $organisation = new Organisation();
            $organisation->name = $user['organisation']['name'];
            $organisation->org_type_id = $user['organisation']['org_type_id'];
            $organisation->tax_id = $user['organisation']['tax_id'];
            $organisation->slug = str_slug($user['organisation']['name'], '-');
            $organisation->org_status_id = $org_status->id;
            $organisation->save();
            
            // create user
            $row = new User();
            $row->first_name = $user['first_name'];
            $row->last_name = $user['last_name'];
            $row->slug = str_slug($user['first_name'] . ' ' . $user['last_name'], '-');
            $row->email = $user['email'];
            $row->password = bcrypt('password');
            $row->user_type_id = $user['type'];
            $row->organisation_id = $organisation->id;
            $row->verified = true;
            $row->save();

            // make user organisation admin
            $orgAdmin = new OrganisationAdmin();
            $orgAdmin->user_id = $row->id;
            $orgAdmin->organisation_id = $organisation->id;
            $orgAdmin->save();
        }

    }
}
