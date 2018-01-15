<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppConfigurationsTableSeeder::class);
        
        $this->call(UserTypesTableSeeder::class);
        $this->call(OrganisationTypesTableSeeder::class);
        $this->call(PetTypesTableSeeder::class);
        $this->call(PhoneTypeTableSeeder::class);
        $this->call(AddressTypeTableSeeder::class);

        $this->call(AdminsTableSeeder::class);
        
        // $this->call(UsersTableSeeder::class);
        
        $this->call(OrganisationStatusesTableSeeder::class);
        
    }
}
