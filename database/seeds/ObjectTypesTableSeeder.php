<?php

use Illuminate\Database\Seeder;

use App\ObjectType;

class ObjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objectTypes = [
            // user types
            [
                'type' => 'user',
                'value' => 'advocate',
                'label' => 'Advocate'
            ],
            [
                'type' => 'user',
                'value' => 'shelter',
                'label' => 'Shelter'
            ],

            //organisation types
            [
                'type' => 'organisation',
                'value' => 'advocate',
                'label' => 'Advocate'
            ],
            [
                'type' => 'organisation',
                'value' => 'shelter',
                'label' => 'Shelter'
            ],
            [
                'type' => 'organisation',
                'value' => 'foster',
                'label' => 'Foster'
            ],

            // pet types
            [
                'type' => 'pet',
                'value' => 'dog',
                'label' => 'Dog'
            ],
            [
                'type' => 'pet',
                'value' => 'cat',
                'label' => 'Cat'
            ],
            [
                'type' => 'pet',
                'value' => 'bird',
                'label' => 'Bird'
            ],
            [
                'type' => 'pet',
                'value' => 'other',
                'label' => 'Other'
            ],

            // address types
            [
                'type' => 'address',
                'value' => 'office',
                'label' => 'Office'
            ],
            [
                'type' => 'address',
                'value' => 'home',
                'label' => 'Home'
            ],
            [
                'type' => 'address',
                'value' => 'other',
                'label' => 'Other'
            ],

            // phone types
            [
                'type' => 'phone',
                'value' => 'office',
                'label' => 'Office'
            ],
            [
                'type' => 'phone',
                'value' => 'home',
                'label' => 'Home'
            ],
            [
                'type' => 'phone',
                'value' => 'mobile',
                'label' => 'Mobile'
            ],
            [
                'type' => 'phone',
                'value' => 'other',
                'label' => 'Other'
            ],
        ];


        foreach ($objectTypes as $type) {
            $objectType = new ObjectType();
            $objectType->type = $type['type'];
            $objectType->value = $type['value'];
            $objectType->label = $type['label'];
            $objectType->save();
        }
    }
}
