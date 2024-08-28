<?php
function compressImage($source, $destination, $quality, $maxWidth, $maxHeight) {
    $info = getimagesize($source);
    
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    } else {
        return false;
    }
    
    // Calculate new dimensions
    list($width, $height) = $info;
    $ratio = $width / $height;
    
    if ($maxWidth / $maxHeight > $ratio) {
        $newWidth = $maxHeight * $ratio;
        $newHeight = $maxHeight;
    } else {
        $newHeight = $maxWidth / $ratio;
        $newWidth = $maxWidth;
    }
    
    // Create new image
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // Preserve transparency for PNG
    if ($info['mime'] == 'image/png') {
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
        imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
    }
    
    // Resize
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
    // Save
    if ($info['mime'] == 'image/jpeg') {
        imagejpeg($newImage, $destination, $quality);
    } elseif ($info['mime'] == 'image/png') {
        $pngQuality = floor((100 - $quality) / 10);
        imagepng($newImage, $destination, $pngQuality);
    }
    
    imagedestroy($image);
    imagedestroy($newImage);
    
    return true;
}

$directory = 'assets/images/photoshoot/';
$quality = 80; // 0 to 100
$maxWidth = 1920;
$maxHeight = 1080;

foreach (new DirectoryIterator($directory) as $fileInfo) {
    if ($fileInfo->isDot()) continue;
    
    $extension = strtolower($fileInfo->getExtension());
    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
        $filePath = $fileInfo->getPathname();
        $newFilePath = $directory . 'compressed_' . $fileInfo->getFilename();
        
        if (compressImage($filePath, $newFilePath, $quality, $maxWidth, $maxHeight)) {
            echo "Compressed: " . $fileInfo->getFilename() . "\n";
            
            // Optionally, replace the original file
            // unlink($filePath);
            // rename($newFilePath, $filePath);
        } else {
            echo "Failed to compress: " . $fileInfo->getFilename() . "\n";
        }
    }
}

echo "Compression complete.\n";
