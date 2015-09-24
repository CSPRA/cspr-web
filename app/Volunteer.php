<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
    	'firstname',
    	'lastname',
    	'contactNumber',
    ];
}
