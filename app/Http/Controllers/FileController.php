<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFileUploadRequest;
use App\Http\Requests\StoreImageUploadRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


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

    public function product_image_store(StoreImageUploadRequest $request) {
        $request->validated();

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_extention = $image_file->getClientOriginalExtension();
            $image_path = $request->image->store('');
            $storage_path = storage_path('app/public');
            $display_file_name = Str::random(40) . ".{$image_extention}";
            $thumbnail_file_name = Str::random(40) . ".{$image_extention}";
            $image_url_prefix =  config('app.url') . '/uploads/';

            $image = Image::make("{$storage_path}/{$image_path}");
            $display_file_name = Str::random(40) . "j";

            $image->resize(597,447)
            ->save("{$storage_path}/$display_file_name");
            $image->resize(212,159)
            ->save("{$storage_path}/$thumbnail_file_name");

            $data = [
                'success' => true,
                'image_url' => [
                    'display_img_url' => "$image_url_prefix/{$display_file_name}",
                    'img_url' => "$image_url_prefix/{$thumbnail_file_name}"
                ]
            ];
            return response()->json($data);
        }
    }
}
