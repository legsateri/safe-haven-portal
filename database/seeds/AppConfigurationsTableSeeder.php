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
            "maintenance_mode" => "0",
            "email_main" => "safe-haven@test.com",
            "recaptcha_public_key" => "",
            "recaptcha_secret_key" => "",
        ];


        foreach ($configuration as $key => $value) {
            $item = new AppConfiguration();
            $item->option_key = $key;
            $item->value = $value;
            $item->save();
        }
    }
}
