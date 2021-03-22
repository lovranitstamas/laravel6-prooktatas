<?php

namespace App\Observers;

use App\Models\ModelHistory;
use Illuminate\Database\Eloquent\Model;

class ModelHistoryObserver
{

    public function saved(Model $model)
    {
        $this->makeHistory($model);

    }

    public function makeHistory($model)
    {
        //$this->getDirty();
        $changesArr = [];

        if ($model->isDirty()) {
            $originalAttributes = $model->getOriginal();

            foreach ($model->getDirty() as $attr => $value) {
                $changesArr[$attr] = [
                    'old' => isset($originalAttributes[$attr]) ? $originalAttributes[$attr] : null,
                    'new' => $value,
                ];
            }

            //$latestVersion = $this->getLatestVersion();
            $history = new ModelHistory;
            $history->historable()->associate($model);
            $history->change = json_encode($changesArr);
            $history->version = $model->history()->count() + 1;
            $history->save();

        }
    }
}
