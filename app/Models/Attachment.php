<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Request;
use File;

class Attachment extends Model
{
    protected $fillable = [
        'employee_id', 'name', 'original_name', 'extension', 'path', 'mime', 'size'
    ];

    /**
     * An avatar belongs to one user
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }

    /**
     * Save image file
     * @param UploadedFile $file
     */
    public function saveAs($id)
    {

        $path = base_path() . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . $id;

        if (!is_dir($path))
        {
            Storage::disk('attachments')->makeDirectory($id);
        }

        $file = Request::file('file');
        $original_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mime = $file->getClientMimeType();
        $size = $file->getClientSize();
        $new_name = time().rand().'.'.$extension;
        $new_path = $id . '/' . $new_name;

        $uploaded = Storage::disk('attachments')->put($new_path, File::get($file->getRealPath()));

        if ($uploaded) {
            $this->employee_id = $id;
            $this->name = sprintf("%s", $new_name);
            $this->original_name = sprintf("%s", $original_name);
            $this->path = sprintf('%s', url('/').Storage::url('attachments/' . $new_path));
            $this->extension = sprintf("%s", $extension);
            $this->mime = sprintf("%s", $mime);
            $this->size = sprintf("%s", $size);
            $this->save();
        }
        return $this;
    }

    public function deleteFile()
    {
        Storage::disk('attachments')->delete($this->employee_id.'/'.$this->name);

        $files = Storage::disk('attachments')->allFiles($this->employee_id);
        if(!count($files))
        {
            Storage::disk('attachments')->deleteDirectory($this->employee_id);
        }

        return $this->delete();

    }

}
