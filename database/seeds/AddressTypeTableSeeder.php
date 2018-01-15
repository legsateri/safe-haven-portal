<?php

use Illuminate\Database\Seeder;

use App\AddressType;

class AddressTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addressTypes = [
            'office',
            'home',
            'other',
        ];

        foreach ($addressTypes as $type)
        {
            $row = new AddressType();
            $row->address_type = $type;
            $row->save();
        }

    }
}
