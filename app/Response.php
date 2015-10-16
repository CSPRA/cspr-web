<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'response';
    protected $fillable = [
    'screeningId',
    'queryId',
    'textAnswer',
    'numberAnswer',
    'boolAnswer',
    'optionGroupId',
    'optionId'];
}
