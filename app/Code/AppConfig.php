<?php
/**
 * application configuration class
 * return object with properties
 */
namespace App\Code;

use DB;

class AppConfig
{
    private $table = "app_configurations";
    public static $instance;
    
    private function __construct()
    {
        $configurations = DB::table($this->table)
                            ->select('option_key', 'value')
                            ->get();

        foreach ($configurations as $option) 
        {
            $this->__set($option->option_key, $option->value);
        }

    }

    /**
     * add new property to object
     */
    private function __set($option, $value)
    {
        $this->$option = $value;
    }

    /**
     * get object instance
     */
    public static function get() {
        if (!isset(AppConfig::$instance)) 
        {
            AppConfig::$instance = new AppConfig();
        }
        return AppConfig::$instance;
    }

}