<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $url = \Storage::putFileAs('images', $file, $fileName);

        return [
            'url' => url($url),
        ];
    }
}
