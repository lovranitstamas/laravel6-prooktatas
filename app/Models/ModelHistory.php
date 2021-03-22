<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHistory extends Model
{

    protected $table = 'model_history';

    protected $casts = [
        'change' => 'array'
    ];

    /*protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $version = self::where('historable_id', $model->historable_id)
                ->where('historable_type', $model->historable_type)
                ->orderBy('created_at', 'desc')
                ->first();
        });
    }*/

    public function historable()
    {
        return $this->morphTo();
    }
}
