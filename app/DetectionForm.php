<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetectionForm extends Model
{
    protected $table = 'detection_form';

    protected $fillable = [
    	'name',
    	'description',
    	'cancerId',
 		'createdBy'
    ];
}
