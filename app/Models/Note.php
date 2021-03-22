<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    //Primary key
    public $primaryKey = 'id';

    //6. óra
    public function setAttributes($data)
    {
        $this->content = $data['content'];
        //$this->user_id = $data['user_id'];
        $this->public_at = isset($data['public_at']) && $data['public_at'] ? $data['public_at'] : null;
        if (isset($data['user_id']) && $data['user_id']) {
            $this->customer()->associate($data['user_id']);
        }
    }

    //6. óra
    public function customer()
    {
        //egy a többhöz, amikor a több oldalt csatoljuk vissza az egy oldalra
        //return $this->belongsTo(Customer::class, 'user_id', 'id');
        return $this->belongsTo('App\Models\Customer', 'user_id', 'id');
    }

    //6. óra
    public function getCustomerName()
    {
        //same namespace
        $customer = Customer::find($this->user_id);

        return $customer->name;
    }

    //6. óra
    public function tags()
    {

        return $this->belongsToMany(
            Tag::class,
            'note_tag',
            'note_id',
            'tag_id')
            ->withTimestamps()
            ->withPivot(['weight']);
    }

    //6. óra
    public function hasTag($tagId)
    {
        //return true;
        return in_array($tagId, $this->tags()->pluck('id')->toArray());
        //return $this->tags()->where('id', $tagId)->count() > 0 ? true : false;

        return $this->tags()->find($tagId);
    }

    //7. óra
    public function scopeOnFrontend($query)
    {

        $now = Carbon::now();
        return $query->whereNotNull('public_at')->whereDate('public_at', '<=', now());
        //$query->whereNotNull('public_at')->where('public_at', '<=', now()->format('Y-m-d H:i:s'));
    }


    //7. óra
    /*public function comments()
    {
        return $this->hasMany(Comment::class);
    }*/

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //7. óra
    public function removeTime($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    /////////////////////
    /*
     * Szemetelés mert minden osztályba be kellene tenni
    public function history()
    {
        return $this->morphMany(ModelHistory::class, 'historable');
    }*/

    use ModelHistoryTrait;

    /*
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->makeHistory();
        });
    }*/
}
