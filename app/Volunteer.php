<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
    	'userId',
    	'firstname',
    	'lastname',
    	'contactNumber',
    ];
}
