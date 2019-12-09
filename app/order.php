<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
	public $with = ['cv'];
    protected $fillable = ['cv_id','name','phone','city','address','post','image','imageI','mobile','email'];

    public function cv() {
    	return $this->belongsTo('App\cv');
    }
}
