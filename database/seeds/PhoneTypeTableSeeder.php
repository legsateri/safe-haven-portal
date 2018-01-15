<?php

use Illuminate\Database\Seeder;

use App\PhoneType;

class PhoneTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phoneTypes = [
            'office',
            'home',
            'mobile',
            'other',
        ];

        foreach ($phoneTypes as $type)
        {
            $row = new PhoneType();
            $row->phone_type = $type;
            $row->save();
        }
    }
}
