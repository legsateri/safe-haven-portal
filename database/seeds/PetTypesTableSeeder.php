<?php

use Illuminate\Database\Seeder;

use App\PetType;

class PetTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petTypes = [
            'dog',
            'cat',
            'bird',
            'reptile',
            'other'
        ];

        foreach ($petTypes as $type)
        {
            $row = new PetType;
            $row->type = $type;
            $row->save();
        }
    }
}
