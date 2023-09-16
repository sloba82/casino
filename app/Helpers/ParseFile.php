<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ParseFile
{

    public static function parseJsonfile($fileName = 'affiliates.txt')
    {
        $file = Storage::disk('local')->get(config('app.file_path') . $fileName);
        $file = str_replace("\n", ',', $file);

        return json_decode("[" . $file . "]", true);
    }
}
