<?php


namespace App\Http\Services\Common;


use App\Http\Services\MyService;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;

class ImageService extends MyService
{
    public function storeImage(Request $request, $folderName, $id)
    {
        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $file) {

                //get filename with extension
                $fileNameWithExtension = $file->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $fileNameToStore = $filename . '_' . uniqid() . '.' . $extension;

                Storage::put('public/' . $folderName . '/' . $fileNameToStore, fopen($file, 'r+'));
                Storage::put('public/' . $folderName . '/thumbnail/' . $fileNameToStore, fopen($file, 'r+'));

                //Resize image here
                $height = Image::make($file)->height();
                $width = Image::make($file)->width();
                $width = $width < 1200 ? $width : 1200;
                $height = $height < 1200 ? $height : 1200;

                $path = public_path('storage/' . $folderName . '/' . $fileNameToStore);
                $img = Image::make($path)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($path);

                $thumbnailPath = public_path('storage/' . $folderName . '/thumbnail/' . $fileNameToStore);
                $img = Image::make($thumbnailPath)->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($thumbnailPath);

                $image = new \App\models\Image([
                    'product_id' => $folderName == 'product' ? $id : null,
                    'user_id' => $folderName == 'user' ? $id : null,
                    'name_to_store' => $fileNameToStore,
                    'path' => 'storage/' . $folderName . '/',
                    'extension' => $extension,
                ]);
                $image->save();
            }
        }
        return true;
    }
}
