<?php

namespace App\Services\Back;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;


class FileUploadService
{
    public function uploadPicture($request, $uploadPath, $width, $height): JsonResponse
    {
        try {

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $targetPath = $uploadPath . "/" . $width . "x" . $height;
                File::ensureDirectoryExists($targetPath, 0755);
                $image = $request->file('image');


                if (!in_array($image->getClientOriginalExtension(), ['jpeg', 'jpg', 'png', 'gif'])) {
                    return response()->json(['Error' => 'Format Uygun Değil'], 400);
                }


                $fileName = md5($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                $fullPath = "$targetPath/$fileName";

                Image::read($image->getRealPath())
                    ->resize($width, $height)
                    ->save($fullPath, 75);

                return response()->json(['Success' => 'Dosya eklendi', 'fileName' => $fullPath], 200);
            }

            return response()->json(['Error' => 'Geçerli bir resim bulunamadı'], 400);
        } catch (\Exception $exception) {
            return response()->json(['Error' => $exception->getMessage()], 400);
        }
    }


    public function fileDelete($uploadPath): JsonResponse
    {

        try {
            if (File::exists($uploadPath)) {
                File::delete($uploadPath);
                return response()->json(['Success' => true], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['Error' => $exception->getMessage()], 400);
        }
        return response()->json(['Success' => true], 200);

    }
}
