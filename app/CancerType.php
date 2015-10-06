<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancerType extends Model
{
    //
    protected $table = 'cancerTypes';
    protected $fillable = [
    	'name',
    	'description',
    ];
}
