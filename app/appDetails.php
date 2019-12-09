<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appDetails extends Model
{
    protected $fillable = [
    	'cv_id',
    	'address',
    	'natonalty',
    	'birthday',
    	'birthplace',
    	'child',
    	'status',
    ];

    public function cv() {
    	return $this->belongsTo('App\cv');
    } 
}
