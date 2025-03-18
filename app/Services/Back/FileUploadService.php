<?php

namespace App\Services\Back;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Throwable;


class FileUploadService
{

    public function uploadPicture($request, $uploadPath, $width, $height): JsonResponse
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $extension = strtolower($image->getClientOriginalExtension());

                if (!in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'svg'])) {
                    return response()->json(['Error' => 'Şəkil Formatı Uyğun Deyil'], 400);
                }

                $targetPath = $uploadPath . "/" . $width . "x" . $height;
                File::ensureDirectoryExists($targetPath);
                $fileName = md5($image->getClientOriginalName()) . '.' . $extension;
                $fullPath = "$targetPath/$fileName";

                if ($extension === 'svg') {
                    $image->move($targetPath, $fileName);
                } else {
                    Image::read($image->getRealPath())
                        ->resize($width, $height)
                        ->save($fullPath, 100);
                }

                return response()->json(['Success' => 'Fayl Yükləndi', 'fileName' => $fullPath]);
            }

            return response()->json(['Error' => 'Uyğu bir şəkil tapılmadı'], 400);
        } catch (\Exception $exception) {
            return response()->json(['Error' => $exception->getMessage()], 400);
        }
    }



    public function multiUpload($request, $uploadPath, $width, $height): JsonResponse
    {
        try {
            if (!$request->hasFile('file')) {
                return response()->json(['Error' => 'Etibarlı fayl tapılmadı'], 400);
            }

            $uploadedFiles = [];
            $files = is_array($request->file('file')) ? $request->file('file') : [$request->file('file')];

            foreach ($files as $file) {
                $extension = strtolower($file->getClientOriginalExtension());
                $allowedImages = ['jpeg', 'jpg', 'png', 'gif'];
                $allowedDocs = ['pdf', 'xlsx', 'xls', 'doc', 'docx'];

                if (!in_array($extension, array_merge($allowedImages, $allowedDocs))) {
                    return response()->json(['Error' => 'Format uyğun değil'], 400);
                }

                $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . "." . $extension;

                if (in_array($extension, $allowedImages)) {

                    $targetPath = "$uploadPath/{$width}x{$height}";
                    File::ensureDirectoryExists($targetPath);

                    Image::read($file->getRealPath())
                        ->resize($width, $height)
                        ->save("$targetPath/$fileName", 80);

                    $uploadedFiles[] = "{$width}x{$height}/$fileName";

                } else {
                    $targetPath = "$uploadPath/documents";
                    File::ensureDirectoryExists($targetPath);

                    $file->move($targetPath, $fileName);
                    $uploadedFiles[] = "documents/$fileName";
                }
            }

            return response()->json([
                'Success' => 'Fayllar əlavə edildi',
                'filePaths' => $uploadedFiles
            ], 200);

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

    public function createDirectory($path): JsonResponse
    {
        try {
            if (empty($path) || !is_string($path)) {
                return response()->json(['Error' => 'Uyğunsuz Qovluq Yolu.'], 400);
            }
            if (File::exists($path)) {
                return response()->json(['Error' => 'Qovluq adı artıq mövcuddur.'], 409);
            }

            File::ensureDirectoryExists($path);

            return response()->json([
                'Success' => "Qovlluq Uğurla Yaradıldı: $path"
            ], 201);

        } catch (Throwable $exception) {
            return response()->json([
                'Error' => 'Dizin oluşturulamadı.',
                'Message' => $exception->getMessage()
            ], 500);
        }

    }

    public function deleteDirectory(string $path): JsonResponse
    {
        try {

            if (empty($path)) {
                return response()->json(['Error' => 'Uyğunsuz Qovluq Yolu.'], 400);

            }


            if (!File::exists($path)) {
                return response()->json(['Error' => 'Qovluq mövcud deyil.'], 404);
            }

            if (!File::isDirectory($path)) {
                return response()->json(['Error' => 'Bu bir qovluq deyil, fayldır.'], 400);
            }
            File::deleteDirectory($path);

            return response()->json([
                'Success' => "Qovluq Uğurla Silindi: $path"
            ], 200);

        } catch (Throwable $exception) {
            return response()->json([
                'Error' => 'Qovluq silinmədi.',
                'Message' => $exception->getMessage()
            ], 500);
        }
    }

    public function renameDirectory(string $oldPath, string $newPath): JsonResponse
    {
        try {

            if (empty($oldPath) || empty($newPath)) {
                return response()->json(['Error' => 'Uyğunsuz Qovluq Yolu.'], 400);
            }


            if (!File::exists($oldPath)) {

                return response()->json(['Error' => 'Mövcud qovluq tapılmadı.'], 404);
            }

            if (!File::isDirectory($oldPath)) {
                return response()->json(['Error' => 'Bu bir qovluq deyil, fayldır.'], 400);
            }


            if (File::exists($newPath)) {
                return response()->json(['Error' => 'Yeni qovluq adı artıq mövcuddur.'], 409);
            }


            File::move($oldPath, $newPath);

            return response()->json([
                'Success' => "Qovluq Uğurla Yenidən Adlandırıldı: $oldPath → $newPath"
            ], 200);

        } catch (Throwable $exception) {
            return response()->json([
                'Error' => 'Qovluq adı dəyişdirilə bilmədi.',
                'Message' => $exception->getMessage()
            ], 500);
        }
    }
}
