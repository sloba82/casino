<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ParseFile
{

    /**
     * @param string $fileName
     * @return mixed
     */
    public static function parseJsonfile(string $fileName = 'affiliates.txt'): mixed
    {
        $file = Storage::disk('local')->get(config('app.file_path') . $fileName);
        $file = str_replace("\n", ',', $file);

        return json_decode("[" . $file . "]", true);
    }
}
