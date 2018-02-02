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
            "recaptcha_public_key" => "6Lfp9EAUAAAAAM53w3qnn7aM7SMG2XrbSCpaQDbR",
            "recaptcha_secret_key" => "6Lfp9EAUAAAAADb9Ty7YH53XmEC9Tb8Hb-z-iHnj",
        ];


        foreach ($configuration as $key => $value) {
            $item = new AppConfiguration();
            $item->option_key = $key;
            $item->value = $value;
            $item->save();
        }
    }
}
