<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['input','language','output','user_id'];

    function user() {
        return $this->belongsTo(User::class);
    }

}
