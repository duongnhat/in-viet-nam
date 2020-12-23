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
                $filenamewithextension = $file->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

                Storage::put('public/' . $folderName . '/' . $filenametostore, fopen($file, 'r+'));
                Storage::put('public/' . $folderName . '/thumbnail/' . $filenametostore, fopen($file, 'r+'));

                //Resize image here
                $thumbnailpath = public_path('storage/' . $folderName . '/thumbnail/' . $filenametostore);
                $img = Image::make($thumbnailpath)->resize(400, 150, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($thumbnailpath);

                $image = new \App\models\Image([
                    'product_id' => $folderName == 'product' ? $id : null,
                    'user_id' => $folderName == 'user' ? $id : null,
                    'name_to_store' => $filenametostore,
                    'path' => public_path('storage/' . $folderName . $filenametostore),
                    'extension' => $extension,
                ]);
                $image->save();
            }
            return true;
        }
    }
}
