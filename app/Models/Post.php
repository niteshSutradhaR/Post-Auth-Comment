<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'post_date','author', 'description', 'tags',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'tags' => 'array',
    // ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
