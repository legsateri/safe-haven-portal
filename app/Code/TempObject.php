<?php
/**
 * handle user temporary data
 * stored in user_temp_data table
 */
namespace App\Code;

use DB;

class TempObject
{
    private $table = "user_temp_data";
    

    /**
     * get object instance
     */
    static function get($user_id, $code) 
    {    
        // get user temp data
        $dataStorageDB = DB::table('user_temp_data')
                        ->where('user_id', $user_id)
                        ->first();
        
        if ( isset($dataStorageDB->user_id) )
        {
            // unserialize data
            $data = unserialize($dataStorageDB->data);

            // check is there requested code
            if ( isset($data[$code]) )
            {
                return $data[$code];
            }
        }
        return null;
    }


    /**
     * insert/update object instance
     */
    static function set($user_id, $code, $data) 
    {
        // get old user data form storage
        $dataStorageDB = DB::table('user_temp_data')
                        ->where('user_id', $user_id)
                        ->first();

        if ( isset($dataStorageDB->user_id) )
        {
            $dataStorage = unserialize($dataStorageDB->data);
            $storageExists = 1;
        }
        else
        {
            $dataStorage = [];
            $storageExists = 0;
        }

        // add value to array
        $dataStorage[$code] = $data;

        // write data to storage
        if ( $storageExists == 1 )
        {
            DB::table('user_temp_data')
            ->where('user_id', $user_id)
            ->update(
                [
                    'data' => serialize($dataStorage),
                    'updated_at' => date("Y-m-d h:i:s")
                ]
            );
        }
        else
        {
            DB::table('user_temp_data')
            ->insert(
                [
                    'user_id' => $user_id, 
                    'data' => serialize($dataStorage),
                    'created_at' => date("Y-m-d h:i:s"),
                    'updated_at' => date("Y-m-d h:i:s")
                ]
            );
        }
    }


    /**
     * remove item from temp table
     */
    static function delete($user_id, $code)
    {
        // get old user data form storage
        $dataStorageDB = DB::table('user_temp_data')
                        ->where('user_id', $user_id)
                        ->first();

        if ( isset($dataStorageDB->user_id) )
        {
            $dataStorage = unserialize($dataStorageDB->data);
            
            if ( isset($dataStorage[$code]) )
            {
                unset($dataStorage[$code]);

                DB::table('user_temp_data')
                ->where('user_id', $user_id)
                ->update(
                    [
                        'data' => serialize($dataStorage),
                        'updated_at' => date("Y-m-d h:i:s")
                    ]
                );
            }
        }
    }
}