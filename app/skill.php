<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skill extends Model
{
    protected $fillable =['cv_id','title'];

    public function cv() {
    	return $this->belongsTo('App\cv');
    }
}
