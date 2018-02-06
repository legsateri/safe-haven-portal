<?php

use Illuminate\Database\Seeder;

use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            // organisation
            [
                'type' => 'organisation',
                'value' => 'submitted',
                'label' => 'Submitted',
                'description' => ''
            ],
            [
                'type' => 'organisation',
                'value' => 'approved',
                'label' => 'Approved',
                'description' => ''
            ],
            [
                'type' => 'organisation',
                'value' => 'review',
                'label' => 'Review',
                'description' => ''
            ],
            [
                'type' => 'organisation',
                'value' => 'suspended',
                'label' => 'Suspended',
                'description' => ''
            ],

            // client_release
            [
                'type' => 'client_release',
                'value' => 'completed',
                'label' => 'Services Completed',
                'description' => ''
            ],
            [
                'type' => 'client_release',
                'value' => 'not_provided',
                'label' => 'Services Not Provided',
                'description' => ''
            ],
            [
                'type' => 'client_release',
                'value' => 'no_longer_needed',
                'label' => 'Services No Longer Needed',
                'description' => ''
            ],

            // pet_release
            [
                'type' => 'pet_release',
                'value' => 'pet_released_to_owner',
                'label' => 'Released to owner',
                'description' => 'The shelter took physical custody of the pet for agreed amount of time and has returned the pet to its owner.'
            ],
            [
                'type' => 'pet_release',
                'value' => 'pet_services_not_provided',
                'label' => 'Services not provided',
                'description' => 'The shelter never took physical custody of the pet because the client chose not to move forward.'
            ],
            [
                'type' => 'pet_release',
                'value' => 'pet_released_to_adoption_pool',
                'label' => 'Released to adoption pool',
                'description' => 'The shelter took physical custody of the pet for the agreed amount of time, and according to the terms of the agreement between the shelter and the client (independent of SHN), the client has relinquished the pet to the shelter.'
            ],
            [
                'type' => 'pet_release',
                'value' => 'pet_not_admitted',
                'label' => 'Pets not admitted',
                'description' => "The shelter accepted the application and began vetting the client\'s situation and pets, and something learned in that process makes it impossible for the shelter to take custody of the pet."
            ],

        ];


        foreach ($statuses as $status) 
        {
            $row = new Status();
            $row->type = $status['type'];
            $row->value = $status['value'];
            $row->label = $status['label'];
            $row->description = $status['description'];
            $row->save();
        }
    }
}
