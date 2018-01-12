<?php
namespace App\Code;

use DB;

class UserObject
{

    public $user = null;

    public function __construct($param, $type)
    {
        if ($type == 'id')
        {
            $this->getUserById($param);
        }
        elseif ($type == 'email')
        {
            $this->getUserByEmail($param);
        }

    }

    private function getUserById($id)
    {
        $user = DB::table('users')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select('users.*', 'user_types.type')
            ->where('users.id', '=', $id)
            ->first();
        
        if ($user)
        {
            $this->user = $user;
        }
    }

    private function getUserByEmail($email)
    {
        $user = DB::table('users')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select('users.*', 'user_types.type')
            ->where('users.email', '=', $email)
            ->first();
        
        if ($user)
        {
            $this->user = $user;
        }
    }

    static function get($param, $type)
    {
        $result = new UserObject($param, $type);
        return $result->user;
    }
}