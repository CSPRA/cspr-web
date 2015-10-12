<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancerType extends Model
{
    //
    protected $table = 'cancer_types';
    protected $fillable = [
    	'name',
    	'description',
    ];
}
