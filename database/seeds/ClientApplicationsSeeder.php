<?php

use Illuminate\Database\Seeder;

use App\ObjectType;
use App\Organisation;
use App\Application;
use App\ApplicationPet;
use App\Client;
use App\Pet;

class ClientApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get organisation type id for advocate
        $advocateTypeOrg = ObjectType::where([
                            ['type', '=', 'organisation'],
                            ['value', '=', 'advocate']
                        ])->first();
        
        // get list of advocate organisations
        $organisations = Organisation::where('org_type_id', $advocateTypeOrg->id)->get();

        

    }
}
