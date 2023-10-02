<?php

$zip = new ZipArchive;
$res = $zip->open(__DIR__.'/files.zip');
if ($res === TRUE) {
  $zip->extractTo( __DIR__.'/files');
  $zip->close();
  echo 'Done!';
} else {
  echo 'Error!';
}