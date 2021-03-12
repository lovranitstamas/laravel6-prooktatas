<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    //7. óra
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //7. óra
    public function note()
    {
        return $this->belongsTo(Note::class);
    }

}
