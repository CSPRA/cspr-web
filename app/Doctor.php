<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
        protected $fillable = [
        'userId',
    	'firstname',
    	'lastname',
    	'contactNumber',
    	'location',
    	'specialization'
    ];
}
