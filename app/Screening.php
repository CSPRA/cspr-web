<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $table = 'screenings';
    protected $fillable = [
    	'patientId',
    	'volunteer',
    	'eventId'
    ];
}
