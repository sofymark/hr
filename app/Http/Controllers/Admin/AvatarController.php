<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MediaRequest;
use App\Models\Avatar;
use App\Traits\BulkActionsTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class AvatarController extends Controller
{

    use BulkActionsTrait;

    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();
        $this->middleware('admin');
        $route = Route::currentRouteName();
    }

    /**
     * Save an avatar
     */
    public function store(MediaRequest $request){
        if(!empty($request->file('image'))) {
            $image = $this->makeImage($request->file('image'));
            return $image->id;
        }

        return redirect()->action('Admin\UserController@index');
    }

    /**
     * Delete an avatar
     */
    public function destroy($id)
    {
        $avatar = Avatar::findOrFail($id);
        File::delete($avatar->path);
        File::delete(str_replace('/','/thumbs/',$avatar->path));
        $avatar->delete();

        return redirect()->back();
    }

    /**
     * Create post file
     *
     * @param UploadedFile $file
     * @return mixed
     */
    protected function makeImage(UploadedFile $file)
    {
        return Avatar::named($file->getClientOriginalName(), $file->getClientOriginalExtension(), $file->getClientMimeType(), $file->getClientSize())
            ->move($file);
    }
}
