<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait RemoveFileTrait
{
    public function unlinkFile(string $path)
    {

        if ($path === null) {
            return false;
        }

        $path = public_path($path);

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
