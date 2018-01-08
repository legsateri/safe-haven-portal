<?php

use Illuminate\Database\Seeder;

use App\OrganisationType;

class OrganisationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisationTypes = [
            'advocate',
            'shelter',
            'foster'
        ];

        foreach ($organisationTypes as $type)
        {
            $row = new OrganisationType;
            $row->type = $type;
            $row->save();
        }
    }
}
