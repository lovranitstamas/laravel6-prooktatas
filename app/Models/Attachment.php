<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{


    public function attachable()
    {
        return $this->morphTo();
    }

    public function addFile($file)
    {
        if (isset($file) && $file && is_file($file)) {
            $uniqueFileName = /*uniqid() .
                '.' .*/
                $file->getClientOriginalName();
            $this->original_filename = $file->getClientOriginalName();

            $path = \Storage::disk('dev')->put('/', $file, ['name' => $uniqueFileName]); //created new filename

            $this->path = $path;

            //\Storage::disk('dev')->download($path);   //download
            //\Storage::disk('dev')->url($path);        //full path

            $this->filename = $uniqueFileName;

        }
    }

    public function publicUrl()
    {
        return \Storage::disk('dev')->url($this->path);
    }
}

