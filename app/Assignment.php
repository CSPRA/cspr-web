<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'event_assignments';
    protected $fillable = [
    	'eventId',
    	'volunteerId',
    	'startingDate',
    	'endingDate'
    ];
}
