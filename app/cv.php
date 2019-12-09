<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cv extends Model
{
    public $with = ['app_details','lastjob','learn','profile','skill'];
    protected $fillable =[
    	'name',
    	'natonalty',
    	'refcode',
    	'gender',
    	'status',
    	'section',
    	'note',
    	'image',
    ];

    public function app_details() {
        return $this->hasOne('App\appDetails');
    }
    public function lastjob() {
        return $this->hasMany('App\lastjob');
    }
    public function learn() {
        return $this->hasOne('App\learn');
    }
    public function profile() {
        return $this->hasOne('App\profile');
    }
    public function skill() {
        return $this->hasMany('App\skill');
    }
}
