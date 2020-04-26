<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
 

    public function user() {
        return $this->hasOne(User::class, 'id', 'poster');
    }
}
