<?php

use Illuminate\Database\Seeder;

use App\AppConfiguration;

class AppConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configuration = [
            "maintenance-mode" => "0",
            "main-email" => "safe-haven@test.com",
        ];


        foreach ($configuration as $key => $value) {
            $item = new AppConfiguration();
            $item->option_key = $key;
            $item->value = $value;
            $item->save();
        }
    }
}
