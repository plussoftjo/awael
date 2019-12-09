<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable =[
    	'cv_id',
    	'religion',
    	'height',
    	'weight',
    	'payment',
    	'loop',
    	'passportnumber',
    ];

    public function cv() {
    	return $this->belongsTo('App\cv');
    }
}
