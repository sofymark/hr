<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class Avatar extends Model
{
    protected $fillable = [
        'name', 'original_name', 'extension', 'path', 'mime', 'size'
    ];

    protected $baseDir = 'avatars';

    /**
     * An avatar belongs to one user
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Build a new image instance from file upload
     */
    public static function named($name, $extension, $mime, $size)
    {
        return (new static)->saveAs($name, $extension, $mime, $size);
    }

    /**
     * Save image file
     * @param UploadedFile $file
     */
    protected function saveAs($name, $extension, $mime, $size)
    {
        $this->name = sprintf("%s%s", time(), rand().'.'.$extension);
        $this->original_name = sprintf("%s", $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->extension = sprintf("%s", $extension);
        $this->mime = sprintf("%s", $mime);
        $this->size = sprintf("%s", $size);
        $this->save();
        return $this;
    }

    /**
     * Store avatar file
     */
    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);
        if(str_contains($this->mime, 'image')){
            Image::make($this->path)
                ->fit(250, 250, function ($constraint) {
                    $constraint->upsize();
                })
                ->orientate()
                ->save($this->baseDir.'/thumbs/' . $this->name);
        }

        return $this;
    }
}
