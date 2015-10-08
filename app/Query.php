<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
