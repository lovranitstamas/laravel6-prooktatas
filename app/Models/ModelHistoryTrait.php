<?php


namespace App\Models;

use App\Observers\ModelHistoryObserver;

trait ModelHistoryTrait
{

    protected static function boot()
    {
        parent::boot();

        /*
        static::deleting(function ($model){
            $model->comments()->delete();
        });*/

        /*
         * Observer miatt nem kell
        static::saved(function ($model) {
            $model->makeHistory();
        });*/

        self::observe(ModelHistoryObserver::class);
    }

    public function history()
    {
        return $this->morphMany(ModelHistory::class, 'historable');
    }

    /* Observer miatt nem kell
     * public function makeHistory()
    {
        //$this->getDirty();
        $changesArr = [];

        if ($this->isDirty()) {
            $originalAttributes = $this->getOriginal();

            foreach ($this->getDirty() as $attr => $value) {
                $changesArr[$attr] = [
                    'old' => isset($originalAttributes[$attr]) ? $originalAttributes[$attr] : null,
                    'new' => $value,
                ];
            }

            $latestVersion = $this->getLatestVersion();
            $history = new ModelHistory;
            $history->historable()->associate($this);
            $history->change = json_encode($changesArr);
            $history->version = $latestVersion ? $latestVersion->version += 1 : 0;
            $history->save();

        }
    }*/

    public function getLatestVersion()
    {
        return $this->history()
            //->where('historable_id', $model->historable_id)
            //->where('historable_type', $model->historable_type)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
