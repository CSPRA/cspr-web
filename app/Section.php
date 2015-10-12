<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $table = 'sections';
    protected $fillable = [
    	'name',
    	'description',
    ];

    public function optionGroups()
    {
        return $this->hasMany('App\OptionGroup', 'sectionId', 'id');
    }
    public function questions()
    {
        return $this->hasMany('App\Question','sectionId','id');
    }

    public function queries()
    {
    	return $this->hasMany('App\Query','sectionId','id');
    }
}
