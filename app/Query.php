<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Section;

class Query extends Model
{
    //
    protected $table = 'query';
    
    protected $fillable = [
    	'formId',
    	'sectionId',
    	'questionId',
    	'questionType',
    	'optionGroupId',
    	'order',
    	'parentQueryId',
    	'units'
    ];

    public function section()
    {
        return $this->belongsTo('Section');
    }
}
