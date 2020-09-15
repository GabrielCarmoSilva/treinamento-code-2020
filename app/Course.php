<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function users() {
        return $this->belongsToMany('App\User', 'course_users');
    }
}
