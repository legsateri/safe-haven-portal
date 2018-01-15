<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgHasPhone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organisation_id',
        'phone_id',
    ];
}
