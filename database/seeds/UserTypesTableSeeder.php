<?php

use Illuminate\Database\Seeder;

use App\UserType;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'advocate'
            ,'shelter'
        ];

        foreach ($types as $type)
        {
            $row = new UserType;
            $row->type = $type;
            $row->save();
        }
    }
}
