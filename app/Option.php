<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $table = 'options';
    
    protected $fillable = [
    	'name',
    	'groupId'
    ];

    public function group()
    {
        return $this->hasOne('App\OptionGroup', 'id', 'groupId');
    }
}
