<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lastjob extends Model
{
    protected $fillable =[
    	'country',
    	'position',
    	'period',
    	'cv_id'
    ];

    public function cv() {
    	return $this->belongsTo('App\cv');
    }
}
