<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    //
    protected $table = 'option_groups';
    
    protected $fillable = [
    	'name',
    	'sectionId'
    ];
    public function options()
    {
        return $this->hasMany('App\Option', 'groupId', 'id');
    }
}
