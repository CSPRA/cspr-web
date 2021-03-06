<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends BaseModel
{
    //
    protected $table = 'questions';
    protected $fillable = [
    	'title',
    	'sectionId'
    ];
    public function section()
    {
        return $this->belongsTo('sections');
    }
}
