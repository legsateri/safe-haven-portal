<?php

use Illuminate\Database\Seeder;

use App\OrganisationStatus;

class OrganisationStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organisationStatuses = [
            'submitted',
            'approved',
            'review',
            'suspended'
        ];

        foreach ($organisationStatuses as $status)
        {
            $row = new OrganisationStatus;
            $row->status = $status;
            $row->save();
        }
    }
}
