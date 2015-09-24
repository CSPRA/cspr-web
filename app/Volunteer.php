<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
    	'username',
    	'email',
    	'password',
    	'firstname',
    	'lastname',
    	'contactNumber',
    ];
}
