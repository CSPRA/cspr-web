<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosisImage extends Model
{
    protected $table = 'diagnosis_images';
    protected $fillable = ['screeningId','description','imageName'];
}
