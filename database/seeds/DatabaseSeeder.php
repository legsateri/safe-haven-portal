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
        $this->call(StatesTableSeeder::class);

        $this->call(ObjectTypesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);

        $this->call(AdminsTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(ClientApplicationsSeeder::class);
        
    }
}
