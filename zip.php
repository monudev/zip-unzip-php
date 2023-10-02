<?php
function createZipFromFolder($source, $destination)
{
    $zip = new ZipArchive();

    if ($zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Initialize an empty stack
        $stack = array($source);

        while (!empty($stack)) {
            $currentFolder = array_pop($stack);
            $files = scandir($currentFolder);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                $filePath = $currentFolder . '/' . $file;

                if (is_dir($filePath)) {
                    $stack[] = $filePath;
                } else {
                    $zip->addFile($filePath, substr($filePath, strlen($source) + 1));
                }
            }
        }

        $zip->close();
        echo "Zip file created successfully! $destination";
    } else {
        echo 'Failed to create zip file';
    }
}


// Usage Example:
$sourceFolder = __DIR__.'/wp-content';
$destinationZipFile = __DIR__.'/wp-content.zip';

createZipFromFolder($sourceFolder, $destinationZipFile);
?>
