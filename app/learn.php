<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class learn extends Model
{
 	protected $fillable = [
 		'cv_id',
 		'arabic',
 		'english',
 		'education',
 	];

 	public function cv() {
    	return $this->belongsTo('App\cv');
    }
}
