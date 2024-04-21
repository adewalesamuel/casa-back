<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFileUploadRequest;
use App\Http\Requests\StoreImageUploadRequest;

class FileController extends Controller
{
    public function file_store(StoreFileUploadRequest $request) {
        $request->validated();

        if ($request->hasFile('file')) {
            $file_url =  config('app.url') . '/uploads/' . $request->file->store('');
            $data = [
                'success' => true,
                'file_url' => $file_url
            ];
            return response()->json($data);
        }

    }

    public function image_store(StoreImageUploadRequest $request) {
        $request->validated();

        if ($request->hasFile('image')) {
            $image_url =  config('app.url') . '/uploads/' . $request->image->store('');
            $data = [
                'success' => true,
                'image_url' => $image_url
            ];
            return response()->json($data);
        }
    }
}
