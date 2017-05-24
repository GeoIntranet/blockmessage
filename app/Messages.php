<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $dates=[
        'updated_at',
    ];

    public function getCreatedAtAttribute($value)
    {
        return  (new Carbon($this->attributes['created_at']))->format('d M H:i');
    }

    public function getDateAttribute($value)
    {
        return  (new Carbon($this->attributes['created_at']))->format('Y-m-d');
    }

}
