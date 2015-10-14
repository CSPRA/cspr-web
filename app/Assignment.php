<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'screening_assignment';
    protected $fillable = [
    	'eventId',
    	'volunteerId'
    ];
}
