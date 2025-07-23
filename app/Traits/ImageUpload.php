<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\File;

trait ImageUpload
{

  /**
   * @param Request $request
   * @return $this|false|string
   */
  public function DBimageUpload($file, $model, $id, $column, $filename = "images")
  {
    $model = "App\Models\\" . $model;
    $image = $model::where('id', $id)->first();
    $imageName = "";
    if (empty($file)) {
      $imageName = $image->$column;
    } else {
      $file = $file;
      $imageName = $this->UploadImage($file, $filename);
    }
    return $imageName;
  }

  public function UploadImage($file, $fileFolder, $deleteOld = false)
  {
    $imageName = sha1(time() . $file->getClientOriginalName()) . '.' . $file->extension();
    $destinationPath = public_path($fileFolder);
    if (!empty($deleteOld)) {
      File::delete($destinationPath . '/' . $deleteOld);
    }
    $file->move($destinationPath, $imageName);
    return $imageName;
  }

  public function unlinkUploadedFile($file, $fileFolder)
  {
    $destinationPath = public_path($fileFolder);
    File::delete($destinationPath . '/' . $file);
    return true;
  }


  public function uploadFiles($fileFolder, $fileType, $model, $file, $deleteOld = false)
  {
    if (!empty($fileFolder)) {
      try {

        $destinationPath = public_path($file);

        if ($deleteOld) {
          File::delete($destinationPath . '/' . $deleteOld);
          Files::where('name', $deleteOld)->where('type', $fileType)->delete();
        }

        $image = time() . $fileFolder->getClientOriginalName();
        $imageName = str_replace(' ', '_', $image);
        $extension = ($fileFolder)->getClientOriginalExtension();
        $fileFolder->move($destinationPath, $imageName);
        // $getFileSize = $fileFolder->getSize();
        $file = new Files;
        $file->file_name = $imageName;
        $file->extension = $extension;
        $file->model_id = $model->id;
        $file->model_type = get_class($model);
        $file->type = $fileType;
        $file->file_size = 0; //temp
        $file->created_by = $model->id;
        $file->save();
        return $file->file_name;
      } catch (\Throwable $e) {
        Log::error('upload fils error!' . $e->getMessage());
      }
    }
  }
}
