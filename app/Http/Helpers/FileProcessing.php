<?php

namespace App\Http\Helpers;

use Illuminate\Http\UploadedFile;


class FileProcessing {

  public static function file_processing(UploadedFile $file, string $path = "/random"){
      $new_file_name = time() .'_'. $file->getClientOriginalName();

      $file->storeAs($path, $new_file_name, 'public');

      return $new_file_name;
  }

}