<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    //6.óra
    public function notes()
    {
        return $this->belongsToMany(
            Note::class,
            'note_tag',
            'tag_id',
            'note_id')
            ->withTimestamps()
            ->withPivot(['weight']);
    }

}
