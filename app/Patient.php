<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
    	'name',
    	'dob',
    	'gender',
    	'maritalStatus',
    	'address',
    	'homePhoneNumber',
    	'mobileNumber',
    	'email',
    	'annualIncome',
    	'occupation',
    	'education',
    	'religion',
        'voterId',
        'adharId',

		'aliveChildrenCount',
		'deceasedChildrenCount'
    ];
}
