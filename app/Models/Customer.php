<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    public $table = 'customers';

    //3.óra
    public function lastUpdated()
    {
        return $this->updated_at->format('Y-m-d');
    }

    //4.óra
    public function setAttributes($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->description = $data['description'];

        if (isset($data['password']) && $data['password']) {
            $this->password = \Hash::make($data['password']);
        }
    }

    //4.óra
    public function scopeFreshRegister($query)
    {
        //az egy hete héten regisztráltak
        $date = Carbon::now()->subWeek()->format('Y-m-d');
        $query->where('created_at', '>', $date);
    }

    //4.óra
    public function scopeSearch($query, $data)
    {
        if (isset($data['name']) && $data['name']) {   //$search['name']  = Horvath;
            $query->where('name', 'LIKE', '%' . $data['name'] . '%');
        }

        if (isset($data['email']) && $data['email']) {   //$search['name']  = Horvath;
            $query->where('email', 'LIKE', '%' . $data['email'] . '%');
        }

        if (isset($data['description']) && $data['description']) {   //$search['name']  = Horvath;
            $query->where('description', 'LIKE', '%' . $data['description'] . '%');
        }

        if (isset($data['orderBy']) && $data['orderBy']) {
            $query->orderBy($data['orderBy'], $data['orderDir']);
        }

        //Customer::where('name', 'LIKE', 'valami')->orWhere('email', 'LIKE', 'másvalami');
    }

    //6. óra
    public function notes()
    {
        return $this->hasMany(
            'App\Models\Note',
            'user_id',
            'id');
    }



    //7. óra
    public function writtenComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
