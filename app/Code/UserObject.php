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
            ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
            ->select('users.*', 'object_types.value')
            ->where('users.id', '=', $id)
            ->first();
        
        if ($user)
        {
            $user->type = $user->value;
            $this->user = $user;
        }
    }

    private function getUserByEmail($email)
    {
        $user = DB::table('users')
            ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
            ->select('users.*', 'object_types.value')
            ->where('users.email', '=', $email)
            ->first();

        if ($user)
        {
            $user->type = $user->value;
            $this->user = $user;
        }
    }

    static function get($param, $type)
    {
        $result = new UserObject($param, $type);
        return $result->user;
    }
}