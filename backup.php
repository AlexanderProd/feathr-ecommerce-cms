<!DOCTYPE html>
<html lang="de">
<body>

<?php
  date_default_timezone_set('CET');
  // Get real path for our folder
  $rootPath = realpath('../s1ck');

  // Initialize archive object
  $zip = new ZipArchive();
  $zip->open('backup/Backup '.date("r").'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

  // Create recursive directory iterator
  /** @var SplFileInfo[] $files */
  $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($rootPath),
      RecursiveIteratorIterator::LEAVES_ONLY
  );

  foreach ($files as $name => $file)
  {
      // Skip directories (they would be added automatically)
      if (!$file->isDir())
      {
          // Get real and relative path for current file
          $filePath = $file->getRealPath();
          $relativePath = substr($filePath, strlen($rootPath) + 1);

          // Add current file to archive
          $zip->addFile($filePath, $relativePath);
      }
  }

  // Zip archive will be created only after closing object
  #$zip->close();
  if($zip->close()){
    echo "Backup succesfull!";
  } else {
    echo "Backup failed";
  }
?>

</body>
</html>
