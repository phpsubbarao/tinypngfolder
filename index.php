<?php 

/**
 * Please take API key from tinypng.com
 **/

require_once 'vendor/autoload.php';
Tinify\setKey("xxxxxxxxxxxxxxxxxxxxxxxxxx");



$di = new RecursiveDirectoryIterator('original');
foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
    if($file->getExtension() == 'jpg' 
        || $file->getExtension() == 'png' 
        || $file->getExtension() == 'webp'
    ) {
        ob_flush(); flush();
        sleep(1);
        $source_path  = $file->getPathname();
        $dest_path = str_replace('original', 'resized', $file->getPathname());
        if(!file_exists($dest_path)) {
            file_exists($dest_path) || mkdir(dirname($dest_path), 0777, true);
            Tinify\fromFile($source_path)->toFile($dest_path);
        }
    }
}

return "Created resized files!";
